<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];
}
