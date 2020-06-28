<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
    public function index()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->with('cartItems')->first();

//        foreach ($cart->cartItems as $item) {
//            dump($item->product);
//        }
//        return $cart->cartItems;
        return view('front-end.cart.index', compact('cart'));
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

    public function cart($productId)
    {
        try {
            $userId = Auth::id();

            $product = Product::where('id', $productId)->first();
            $cartExist = Cart::where('user_id', $userId)->with('cartItems')->first();

            if(!$cartExist) {
                $cartData = ['user_id'=> $userId];

                if($cart = Cart::create($cartData)) {
                    $cartItemData = [
                        'cart_id'   => $cart->id,
                        'product_id'=> $product->id,
                        'quantity'  => 1,
                        'price'     => $product->price,
                    ];
                    if($cartItem = CartItem::create($cartItemData)) {
                        if($this->calculateCart($cart)) {
                            return redirect()->route('research.list')->with('success', 'Item Added To Cart Successfully');
                        }
                    }
                }
            }else {
                $existItem = CartItem::where('cart_id', $cartExist->id)->where('product_id', $productId)->first();

                if($existItem) {
                    $existItem->quantity += 1;
                    $existItem->price = $existItem->quantity * $product->price;
                    if($existItem->save()) {
                        if($cart = $this->calculateCart($cartExist)) {
                            return redirect()->route('research.list')->with('success', 'Item Added To Cart Successfully');
                        }
                    }
                } else {
                    $cartItemData = [
                        'cart_id'   => $cartExist->id,
                        'product_id'=> $product->id,
                        'quantity'  => 1,
                        'price'     => $product->price,
                    ];
                    if($cartItem = CartItem::create($cartItemData)) {
                        if($cart = $this->calculateCart($cartExist)) {
                            return redirect()->route('research.list')->with('success', 'Item Added To Cart Successfully');
                        }
                    }
                }

            }
        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }

    }

    public function calculateCart($cart) {
        try{
            $cartTotal = 0;
            $cartItems = CartItem::where('cart_id', $cart->id)->get();


            foreach ($cartItems as $cartItem) {
                $cartTotal += $cartItem->price;
            }
            $cart->total = $cartTotal;
            return $cart->save();

        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }
    }

    /**
     * take cart item id for delete
     * @param $id
     */
    public function delete($cartItemId) {
        try {

            $cartItem = CartItem::find($cartItemId);

            if($cartItem) {
                $cart = Cart::find($cartItem->cart_id);

                $cartTotal = $cart->total - $cartItem->price;
                $cart->total = $cartTotal;
                $cart->save();

                $cartItem->delete();
            }

        } catch(\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 420);
        }

        return redirect()->route('cart')->with('success', 'Item Removed from cart.');
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
