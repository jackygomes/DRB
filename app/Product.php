<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    //
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'ticker_id',
        'sector_id',
        'provider',
        'category_id',
        'date',
        'analysts',
        'description',
        'report_excel',
        'report_pdf',
        'price'
    ];

    /**
     * Returns associated company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company() {
        return $this->hasOne(Company::class, 'id','ticker_id');
    }

    public function sector() {
        return $this->hasOne(Sector::class, 'id','sector_id');
    }

    public function category() {
        return $this->hasOne(Category::class, 'id','category_id');
    }
}
