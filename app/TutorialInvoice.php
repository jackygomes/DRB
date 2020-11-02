<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorialInvoice extends Model
{
    protected $fillable = [
        'user_id',
        'tutorial_id',
        'amount',
        'is_paid',
        'transaction_id',
        'expiry_date',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
