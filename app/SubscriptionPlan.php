<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends DrbModel
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
