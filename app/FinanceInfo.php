<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinanceInfo extends DrbModel
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
