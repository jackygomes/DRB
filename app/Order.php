<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'user_id',
        'transaction_id',
        'amount',
        'status',
        'payment'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id','id');
    }
}
