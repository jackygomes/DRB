<?php

namespace App\Models;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'type',
        'publishing_date',
        'readable_publishing_date',
        'newsletter_content',
        'thumbnail',
        'created_by',
    ];

    public function category(){
        return $this->belongsTo(NewsletterCategory::class, 'category_id', 'id');
    }
}
