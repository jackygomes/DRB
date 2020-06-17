<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    //
    protected $fillable = [
        'user_id',
        'total'
    ];

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'cart_id','id');
    }

    public static function getCartCount() {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)->first();
            if($cart){
                $cartItems = CartItem::where('cart_id', $cart->id)->get();
                $count = 0;
                foreach($cartItems as $cartItem) {
                    $count += $cartItem->quantity;
                }
                if($count > 0) return $count;
                else return 0;
            } else return 0;
        } else {
            return 0;
        }
    }
}
