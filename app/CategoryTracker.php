<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTracker extends Model
{
    protected $fillable = ['user_id', 'category_visited'];
}
