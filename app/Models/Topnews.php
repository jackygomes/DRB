<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topnews extends Model
{
    protected $fillable = [
        'heading',
        'source'     ,
        'source_name',
        'image',
    ];
}
