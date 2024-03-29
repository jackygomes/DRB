<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Subscriber;
use App\SubscriptionPlan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('isApproved', 1)->orderBy('id', 'DESC')->get();
        //return $invoices;
        return view('back-end.invoice.index', compact('invoices'));
    }

    public function invoiceUser()
    {
        $invoices = Invoice::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return view('back-end.user-dashboard.invoice.index', compact('invoices'));
    }

    public function getUser()
    {
        $subscriber = Subscriber::where('creator', auth()->user()->id)->latest()->first();
       if( $subscriber != null){
            $subscribers =Subscriber::where('invoice_id', $subscriber->invoice_id)->get();
            return view('back-end.user-dashboard.subscriber.index', compact('subscribers'));
       }else{
        return redirect()->back()->with('error', 'Please purchase any package');
       }

    }

    public function postUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user != null){
            $invoice = Invoice::where('user_id', auth()->user()->id)->latest()->first();
            $subscribers = Subscriber::where('invoice_id', $invoice->id)->get();
            $subscriber_id = $subscribers->pluck('user_id')->toArray();
            if($subscribers->count() < $invoice->user_limit){
                if(in_array($user->id, $subscriber_id)){
                    return redirect()->back()->with('error', 'This user already exists');
                }else{
                    $subscriber = new Subscriber;
                    $subscriber->invoice_id = $invoice->id;
                    $subscriber->creator = auth()->user()->id;
                    $subscriber->user_id = $user->id;
                    $subscriber->expire_date =  $invoice->expire_date;
                    $subscriber->save();
                }
            }else{
                return redirect()->back()->with('error', 'User limit exceeded');
            }
        }else {
            return redirect()->back()->with('error', 'User not found');
        }
        return redirect()->back();
    }

    public function invoiceShow($id)
    {
        $invoice = Invoice::find($id);
        // dd($invoice);
        return view('back-end.user-dashboard.invoice.invoice', compact('invoice'));
    }

    public function destroy($id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->delete();
        return redirect()->back();
    }

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    public function makeManualInvoice($request, $user)
    {
        $invoiceCounter = Invoice::count();
        $tran_id = time().bin2hex(random_bytes(6));
        $uniqueId =  '#'.'DRB'.date("Y").($invoiceCounter + 1);

        $invoice = new Invoice;
        $invoice = $this->handleInvoiceType($invoice, $user, $request, $uniqueId, $tran_id);
        $invoice->save();

        return $invoice;
    }

    /**
     * @param $invoice
     * @param $user
     * @param $request
     * @param $uniqueId
     * @param $tran_id
     * @return mixed
     */
    public function handleInvoiceType($invoice, $user, $request, $uniqueId, $tran_id)
    {
        $plan = SubscriptionPlan::where('id', $request->plan)->first();

        $invoice->type = $request->validity;
        $invoice->expire_date =  $request->validity == 'yearly' ? Carbon::now()->addYear() : now()->addMonth();

        $invoice->user_id = $user->id;
        $invoice->plan_id = $request->plan;
        $invoice->unique_id = $uniqueId;
        $invoice->price = 0;
        $invoice->user_limit = $plan->user_limit;
        $invoice->transaction_id = $tran_id;
        $invoice->payment_type = 'manual';
        $invoice->isApproved = 1;

        return $invoice;
    }
}
