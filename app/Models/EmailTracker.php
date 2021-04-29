<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTracker extends Model
{
    protected $fillable = ['title', 'num_of_audience', 'uid'];

    public function audiences()
    {
        return $this->hasMany(EmailTrackerAudience::class, 'email_tracker_uid', 'uid');
    }
}
