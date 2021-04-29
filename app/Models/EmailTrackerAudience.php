<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTrackerAudience extends Model
{
    protected $fillable = ['email_tracker_uid', 'name', 'email'];
}
