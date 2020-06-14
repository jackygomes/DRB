<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends DrbModel
{
    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }

    public function financeInfos()
    {
        return $this->hasMany('App\FinanceInfo');
    }

    public function stockInfo()
    {
        return $this->hasOne('App\StockInfo');
    }

    public function scopeWithStockInfo($query){
        return $this->stockInfo != null;
    }
}
