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
}
