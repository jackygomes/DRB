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
use Illuminate\Support\Facades\Log;
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

    public function subscribePlan(Request $request, SslPaymentController $sslPayment)
    {

        $invoice = Invoice::all();
        $tran_id = strtoupper(time().bin2hex(random_bytes(6)));
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
        if($request->hasFile('check_image')) {
            $image = $request->file('check_image');

            //$image->getSize()/1000000 size in mb
            if(($image->extension() == 'jpeg' || $image->extension() == 'png' || $image->extension() == 'pdf') && round($image->getSize()/1000000) <= 2 ){
                $invoice->payment_type = 'offline';
                $invoice->check_image = time(). '.' .$image->extension();
                $request->file('check_image')->move(storage_path('app/public/bank_checks'), $invoice->check_image);
                $offlineInvoiceFlag = true;
            }else
                return redirect()->back()->with('error', 'Upload Image or Pdf Only & File Must Be Under 3Mb');

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
            $offlineSuccessMsg = 'Your subscription will be activated after 24 hours';
            return view('back-end.subscription-plan.success', compact('offlineSuccessMsg'));
        }

        //payment
        $redirectUrl = $sslPayment->makePaymentRequest($request->price, config('drb.paymentType.subscription'), $tran_id);
        return redirect($redirectUrl);
    }

    //not in used for now
    public function fail()
    {
        $invoice = Invoice::where('user_id', auth()->user()->id)->latest()->first();
        $invoice->delete();
        $subscriber = Subscriber::where('creator', auth()->user()->id)->latest()->first();
        $subscriber->delete();
        return view('back-end.subscription-plan.fail');
    }

    public function makeManualSubscriber($invoiceId, $user)
    {
        $subscriber = new Subscriber;
        $subscriber->invoice_id = $invoiceId;
        $subscriber->creator = auth()->user()->id;
        $subscriber->user_id = $user->id;
        $subscriber->expire_date =  Carbon::now()->addMonth();
        $subscriber->save();
    }
}
