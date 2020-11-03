<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\TutorialInvoice;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SslPaymentController extends Controller
{
    public function makePaymentRequest($amount, $productType, $transactionId){

        $requireSslData = [
            'store_id' => env('SSL_STORE_ID'),
            'store_passwd' => env('SSL_STORE_PASS'),
            'total_amount' => $amount,
            'currency' => 'BDT',
            'tran_id' => $transactionId,
            'success_url' => route('drb.payment.success'),
            'fail_url' => route('drb.payment.fail'),
            'cancel_url' => route('home'),
            'cus_name' => auth()->user()->full_name,
            'cus_email' => auth()->user()->email,
            'cus_add1' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_postcode' => '1215',
            'cus_country' => 'Bangladesh',
            'cus_phone' => auth()->user()->contact_number,
            'shipping_method' => 'NO',
            'num_of_item' => 1,
            'product_name' => 'non-physical-goods',
            'product_category' => 'non-physical-goods',
            'product_profile' => 'non-physical-goods',
            'value_a' => $productType,
        ];

        try{
            $client = new Client(['verify' => false]);
            $response = $client->request('POST', config('drb.sslPaymentUrls.requestUrl'), [     //securepay
                'form_params' => $requireSslData
            ]);

        }catch(\Exception $e){
            return $e->getMessage();
        }

        return json_decode($response->getBody())->GatewayPageURL;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function makePaymentOnSuccess(Request $request){
        //tutorial payment
        if($request->status == 'VALID' && $this->verifyPayment($request->val_id)){

            if($request->value_a == config('drb.paymentType.tutorial')){
                $invoice = TutorialInvoice::where('user_id', auth()->user()->id)->where('transaction_id', $request->tran_id)->first();
                $invoice->is_paid = 1;
                $invoice->update();
                return view('back-end.subscription-plan.success');

            }elseif ($request->value_a == config('drb.paymentType.subscription')){
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

            }elseif ($request->value_a == config('drb.paymentType.research')){

                $order = Order::where('transaction_id', $request->tran_id)->first();
                $order->status = 'complete';
                $order->payment = 'paid';
                $order->save();
                $status = 'success';

                return view('front-end.payment-status.success', compact('status'));
            }

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handleFailedPayment(Request $request)
    {
        return view('back-end.subscription-plan.fail');
    }

    /**
     * @param $valId
     * @return bool
     */
    public function verifyPayment($valId)
    {

        $requested_url = (config('drb.sslPaymentUrls.validationUrl') . "?val_id=" . $valId . "&store_id=". env('SSL_STORE_ID') ."&store_passwd=". env('SSL_STORE_PASS') ."&v=1&format=json");

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

        $result = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle)))
        {
            return true;
        }else
            return false;
        
    }
}
