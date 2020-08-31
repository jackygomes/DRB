<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Mail\Subscribe;
use App\Subscriber;
use App\SubscriptionPlan;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Auth;
use Kreait\Firebase\Storage;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $subscriptionplans = SubscriptionPlan::orderBy('name')->get()->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
       return view('back-end.subscription-plan.index', compact('subscriptionplans'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price_per_month' => 'required',
            'price_per_year' => 'required'
        ]);

        if($request->get('is_visible') == null){
            $is_visible = 0;
          } else {
            $is_visible = request('is_visible');
        }


        $subscriptionplan = new SubscriptionPlan([
            'name' => $request->get('name'),
            'price_per_month' => $request->get('price_per_month'),
            'price_per_year' => $request->get('price_per_year'),
            'user_limit' => $request->get('user_limit'),
            'is_visible' => $is_visible,
        ]);
        $subscriptionplan->save();
        return redirect()->route('subscriptionplan.index')->with('success', 'Subscription Plan has been created successfully');
    }

    public function edit($id)
    {
        $subscriptionplan = SubscriptionPlan::find($id);
        return view('back-end.subscription-plan.edit', compact('subscriptionplan'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price_per_month' => 'required',
            'price_per_year' => 'required'
        ]);

        if($request->get('is_visible') == null){
            $is_visible = 0;
          } else {
            $is_visible = request('is_visible');
        }

        $subscriptionplan = SubscriptionPlan::find($id);
        $subscriptionplan->name = $request->get('name');
        $subscriptionplan->price_per_month = $request->get('price_per_month');
        $subscriptionplan->price_per_year = $request->get('price_per_year');
        $subscriptionplan->user_limit = $request->get('user_limit');
        $subscriptionplan->is_visible = $is_visible;
        $subscriptionplan->save();
        return redirect()->route('subscriptionplan.index')->with('success', 'Subscription Plan has been updated successfully');
    }

    public function destroy($id)
    {
        $subscriptionplan = SubscriptionPlan::find($id);
        $subscriptionplan->delete();
        return redirect()->route('subscriptionplan.index')->with('success', 'Subscription Plan has been deleted successfully');
    }

    function original(){
        return new Carbon;
    }

    public function subscribePlan(Request $request)
    {
        //return time().'.' .$request->check_image->extension();

        $invoice = Invoice::all();
        $tran_id = time().bin2hex(random_bytes(6));
        $uniqueid =  '#'.'DRB'.date("Y").(count($invoice)+1);

        $invoice = new Invoice;
        $invoice->user_id = auth()->user()->id;
        $invoice->plan_id = $request->plan_id;
        $invoice->unique_id = $uniqueid;
        $invoice->price = $request->price;
        $invoice->type = $request->type;
        $invoice->user_limit = $request->user_limit;
        $invoice->transaction_id = $tran_id;
        $invoice->payment_type = 'online';
        $invoice->isApproved = 0;

        if ($request->type == 'monthly')
        {
            $invoice->expire_date =  $this->original()->addMonths(1);
        }else {
            $invoice->expire_date =  $this->original()->addMonths(12);
        }

        //offline payment
        if($request->transaction_id && $request->hasFile('check_image')) {
            $invoice->payment_type = 'offline';
            $invoice->transaction_id = $request->transaction_id ;
            $invoice->check_image = time(). '.' .$request->check_image->extension();
            $request->file('check_image')->move(storage_path('app/public/bank_checks'), $invoice->check_image);
            $offlineInvoiceFlag = true;
        }

        $invoice->save();

        $subscriber = new Subscriber;
        $subscriber->Invoice_id = $invoice->id;
        $subscriber->creator = auth()->user()->id;
        $subscriber->user_id = auth()->user()->id;
        if ($request->type == 'monthly')
        {
            $subscriber->expire_date =  $this->original()->addMonths(1);
        }else {
            $subscriber->expire_date =  $this->original()->addMonths(12);
        }
        $subscriber->save();

        if(isset($offlineInvoiceFlag) && $offlineInvoiceFlag){
            return view('back-end.subscription-plan.success');
        }

        $user = Auth::user();
        $store_id = env('SSL_STORE_ID', false);
        $store_pass =  env('SSL_STORE_PASS', false);

        $requireSslData = [
            'store_id' => $store_id,
            'store_passwd' => $store_pass,
            'total_amount' => $request->price,
            'currency' => 'BDT',
            'tran_id' => $tran_id,
            'success_url' => route('subscriptionplan.success'),
            'fail_url' => route('subscriptionplan.fail'),
            'cancel_url' => route('home'),
            'cus_name' => $user->full_name,
            'cus_email' => $user->email,
            'cus_add1' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_postcode' => '1215',
            'cus_country' => 'Bangladesh',
            'cus_phone' => $user->contact_number,
            'shipping_method' => 'NO',
            'num_of_item' => 1,
            'product_name' => 'Package',
            'product_category' => 'package',
            'product_profile' => 'non-physical-goods',
        ];

        try{
            $client = new Client(['verify' => false]);
            $response = $client->request('POST', 'https://securepay.sslcommerz.com/gwprocess/v4/api.php', [
                'form_params' => $requireSslData
            ]);

        }catch(\Exception $e){
            return $e->getMessage();
        }



        return redirect(json_decode($response->getBody())->GatewayPageURL);
    }

    public function success(Request $request)
    {
        if($request->status == 'VALID' && $request->tran_id){
            $invoice = Invoice::where('user_id', auth()->user()->id)->where('transaction_id', $request->tran_id)->first();
            $invoice->isApproved = 1;
            $invoice->save();

            //upgraded user to paid user
            $user = auth()->user();
            if($user->type != 'paid' && $user->type != 'admin'){
                $user->type = 'paid';
                $user->save();
            }

            return view('back-end.subscription-plan.success');

        }else{
            return view('back-end.subscription-plan.fail');
        }
    }

    public function fail()
    {
        $invoice = Invoice::where('user_id', auth()->user()->id)->latest()->first();
        $invoice->delete();
        $subscriber = Subscriber::where('creator', auth()->user()->id)->latest()->first();
        $subscriber->delete();
        return view('back-end.subscription-plan.fail');
    }
}
