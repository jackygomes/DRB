<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends DrbModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
