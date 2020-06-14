<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends DrbModel
{
    public function parent() {
        return $this->belongsTo('App\Menu','parent_menu_id');
    }

    public function page() {
        return $this->hasOne('App\Page');
    }
}
