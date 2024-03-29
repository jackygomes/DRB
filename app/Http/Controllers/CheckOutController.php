<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

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

//    public function checkoutPage(Request $request)
//    {
//        $userId = Auth::id();
//        $userInfo = User::where('id', $userId)->first();
//        $this->validate($request, [
//            'cart_id'  =>  'required',
//        ]);
//
//        try {
//            $cart = Cart::where('id', $request->cart_id)->with('cartItems')->first();
//        } catch(\Exception $e) {
//            return response()->json([
//                'status'    => 'error',
//                'message'   => $e->getMessage(),
//            ], 420);
//        }
//
//        return view('front-end.cart.checkout', compact('cart','userInfo'));
//    }

    /**
     * Cart ID
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkOut(Request $request)
    {
        $userId = Auth::id();

        $this->validate($request, [
            'cart_id'  =>  'required',
        ]);

        $cartId = $request->cart_id;

        try {
            $userInfo = User::find($userId);
            $cart = Cart::where('id', $cartId)->with('cartItems')->first();
            $productNames = [];
            $productCategories = [];
            $productQuantity = 0;

            foreach ($cart->cartItems as $item) {
                array_push($productNames, $item->product->name);
                if(!in_array($item->product->category->name, $productCategories)) {
                    array_push($productCategories, $item->product->category->name);
                }
                $productQuantity += $item->quantity;
            }
            $paymentDataInfo = [
                'cart'              => $cart,
                'user'              => $userInfo,
                'productNames'      => json_encode($productNames),
                'productCategories' => json_encode($productCategories),
                'productQuantity'   => $productQuantity
            ];
            $paymentData = $this->createPayment($paymentDataInfo);

            if($paymentData){
                $orderData = [
                    'order_no'          => 'DRB_'.Str::random(6),
                    'user_id'           => $cart->user_id,
                    'transaction_id'    => $paymentData['tran_id'],
                    'amount'            => $cart->total
                ];

                if($order = Order::create($orderData)) {
                    foreach ($cart->cartItems as $item) {
                        $orderItemData = [
                            'order_id'      => $order->id,
                            'product_id'    => $item->product_id,
                            'quantity'      => $item->quantity,
                            'total'         => $item->price,
                        ];
                        OrderItem::create($orderItemData);

                        $product = Product::find($item->product_id);
                        $product->sell_count += 1;
                        $product->save();
                    }
                }
            foreach ($cart->cartItems as $item) {
                $cartItem = CartItem::find($item->id);
                $cartItem->delete();
            }
            $cart->delete();
            }

        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }

        //if price is less than 10 (for ssl minimum amount purposes) make it successful by default
        if($orderData['amount'] < 10) {

            $order = Order::where('transaction_id', $orderData['transaction_id'])->first();
            $order->status = 'complete';
            $order->payment = 'paid';

            $order->save();

            $status = 'success';
            return view('front-end.payment-status.success', compact('status'));
        }

        $this->makePayment($paymentData);
    }

    /** creating payment data
     * @param $paymentData
     * @return array
     */
    private function createPayment($paymentData)
    {

        $post_data = array();

        $post_data['store_id'] = env('SSL_STORE_ID');
        $post_data['store_passwd'] = env('SSL_STORE_PASS');
        $post_data['total_amount'] = $paymentData['cart']->total;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "DRB_" . uniqid();
        $post_data['success_url'] = route('drb.payment.success');
        $post_data['fail_url'] = route('drb.payment.fail');
        $post_data['cancel_url'] = route('home');

        $post_data['emi_option'] = "0";

        $post_data['cus_name'] = $paymentData['user']->full_name;
        $post_data['cus_email'] = $paymentData['user']->email;
        $post_data['cus_add1'] = '117 Tejkuni Para Old Airport road Rangs Bhaban, Tejgaon';
        $post_data['cus_city'] = 'Dhaka';
        $post_data['cus_postcode'] = '1215';
        $post_data['cus_country'] = 'Bangladesh';
        $post_data['cus_phone'] = isset($paymentData['user']->contact_number) ? $paymentData['user']->contact_number : '0178517954';

        $post_data['shipping_method'] = "NO";
        $post_data['num_of_item'] = $paymentData['productQuantity'];

        $post_data['product_name'] = implode(', ', json_decode($paymentData['productNames']));
        $post_data['product_category'] = implode(', ', json_decode($paymentData['productCategories']));
        $post_data['product_profile'] = "general";
        $post_data['value_a'] = config('drb.paymentType.research');

        return $post_data;
    }

    /** making payment
     * @param $paymentData
     */
    private function makePayment($paymentData) {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, config('drb.sslPaymentUrls.requestUrl') );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $paymentData);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle );

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !(curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );

        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {

            header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }

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
