<?php
/**
 * Created by PhpStorm.
 * User: Mahfuz
 * Date: 4/13/2021
 * Time: 12:19 PM
 */

namespace App\Service;

use App\Invoice;
use App\Jobs\ProcessPackageNotification;
use App\SubscriptionPlan;
use Illuminate\Support\Facades\Log;

class PackageExpirationNotifyService
{
    public function notifyTrialUsersAfterExpiration(){
        try{
            $trialPackage = SubscriptionPlan::where('name', 'trial')->first();

            if($trialPackage){
                $invoices = Invoice::where('plan_id', $trialPackage->id)
                    ->where('expire_date', now()->subDay()->toDateString())
                    ->with('user')
                    ->with('subscriptionplan')
                    ->get();

                foreach ($invoices as $invoice){
                    ProcessPackageNotification::dispatch($invoice->user->email, $invoice->subscriptionplan->name)->delay(5);
                }
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }


    /**
     *3days before
     */
    public function notifyPremiumAndCorporateUsersBeforeExpiration(){
        try{
        $packages = SubscriptionPlan::where('name', 'premium')->orWhere('name', 'corporate')->get();
        //return $packages;

            if(count($packages) > 1){
                $invoices = Invoice::where('expire_date', now()->addDays(3)->toDateString())
                    ->where(function ($q) use ($packages){
                        return $q->where('plan_id', $packages[0]->id)->orWhere('plan_id', $packages[1]->id);
                    })
                    ->with('user')
                    ->with('subscriptionplan')
                    ->get();

                foreach ($invoices as $invoice){
                    ProcessPackageNotification::dispatch($invoice->user->email, $invoice->subscriptionplan->name)->delay(5);
                }
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}