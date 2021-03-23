<?php

namespace App\Models;

use App\News;
use Illuminate\Database\Eloquent\Model;

class NewsletterCategory extends Model
{
    protected $fillable = ['category'];

    public function newsletter(){
        return $this->hasMany(Newsletter::class, 'category_id', 'id');
    }
}
