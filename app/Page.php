<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends DrbModel
{
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    public function pageItems()
    {
        return $this->hasMany('App\PageItem')->orderBy('updated_at', 'DESC');
    }
}
