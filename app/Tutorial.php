<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = [
        'tutorial_category_id',
        'name'          ,
        'tutorial_image',
        'date'          ,
        'trainers'      ,
        'description'   ,
        'attendees'     ,
        'curriculum'    ,
        'requirement'   ,
        'price'         ,
        'status'        ,
    ];
}
