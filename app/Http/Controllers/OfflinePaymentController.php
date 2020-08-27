<?php

namespace App\Http\Controllers;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfflinePaymentController extends Controller
{
    public function index(){
        $invoices = Invoice::where('isApproved', 0)->get();
        return view('back-end.offline-payment.index', compact('invoices'));
    }

    public function invoiceDetails($invoice_id){
        $invoice = Invoice::where('id', $invoice_id)->first();
        return view('back-end.offline-payment.details', compact('invoice'));
    }

    public function approvePayment($invoice_id){
        $invoice = Invoice::where('id', $invoice_id)->first();
        $invoice->isApproved = 1;
        $invoice->save();
        return redirect()->route('offline.payments')->with('success', 'Payment Is Approved');
    }

    public function deletePayment($invoice_id)
    {
        Invoice::destroy($invoice_id);
        return response()->json(['status' => 200]);
    }
}
