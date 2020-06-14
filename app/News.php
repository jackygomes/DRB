<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends DrbModel
{
    protected $appends = ['human_readable_time'];

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'DESC');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getHumanReadableTimeAttribute(){
        return $this->updated_at->diffForHumans();
    }
}
