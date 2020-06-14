<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends DrbModel
{
    public function company(){
        return $this->hasMany('App\Company')->orderBy('name');
    }
}
