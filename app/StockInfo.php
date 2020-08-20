<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockInfo extends DrbModel
{
    
    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function getThreeYearRevenueCagrAttribute(){
        if($this->beginning_revenue!=0){
            $result = ((($this->ending_revenue / $this->beginning_revenue) ** (1/3))-1)*100;
            return $result;
        }
        return '';
    }

    public function getRoaAttribute(){
        if(($this->beginning_asset + $this->ending_asset)!=0){
            $result = ($this->npat / (($this->beginning_asset+$this->ending_asset)/2)) *100;
            if($result<0){
                return 'n/a';
            }else{
                return $result;
            }
        }
        return '';
    }

    public function getRoeAttribute(){
        if(((float) $this->beginning_equity + (float) $this->ending_equity)!=0){
            $result = ($this->npat_non_controlling_interest / (($this->beginning_equity+$this->ending_equity)/2)) *100;
            if($result<0){
                return 'n/a';
            }else{
                return $result;
            }
        }
        return '';
    }

    public function getAuditedEpsAttribute(){
        if((((float)$this->pe_1_basic))!=0){
            return (((float)$this->last_trading_price )/ ((float)$this->pe_1_basic));
        }
        return '';
    }

    public function getPnavpsXattribute(){
        if((((float)$this->navps))!=0){
            $result = (((float)$this->last_trading_price )/ ((float)$this->navps));
            if($result<0){
                return 'n/a';
            }else{
                return $result;
            }
        }
        return '';
    }

    public function getDividendYieldAttribute(){
        if((((float)$this->last_trading_price))!=0){
            return (((float)$this->dps )/ ((float)$this->last_trading_price)) *100;
        }
        return '';
    }

    public function getThreeYearNpatCagrAttribute(){
        if($this->beginning_npat!=0){
            $result = ((($this->ending_npat / $this->beginning_npat) ** (1/3))-1)*100;
            return $result;
        }
        return '';
    }
}