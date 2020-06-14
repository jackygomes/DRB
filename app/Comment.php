<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends DrbModel
{
    protected $appends = ['username','human_readable_time'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getUserNameAttribute(){
        return $this->user->full_name;
    }

    public function getHumanReadableTimeAttribute(){
        return $this->updated_at->diffForHumans();
    }
    
    
}
