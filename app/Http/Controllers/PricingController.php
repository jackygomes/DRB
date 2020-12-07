<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activePlan = null;
        $pendingPlan = null;

        if(auth()->user()) {

            $invoice = Invoice::where('user_id', auth()->user()->id)->where('isApproved', 1)->orderby('id', 'DESC')->first();

            if($invoice && $invoice->isApproved && $invoice->expire_date >= Carbon::now())
                $activePlan = $invoice->plan_id;
            if($invoice && !$invoice->isApproved && $invoice->expire_date >= Carbon::now())
                $pendingPlan = $invoice->plan_id;
        }
        $subscriptionplans = SubscriptionPlan::where('is_visible', 1)->get();
        return view('front-end.pricing.index', compact('subscriptionplans', 'activePlan', 'pendingPlan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
