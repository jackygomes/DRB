<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends DrbModel
{
    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

    public function surveyAnswerOptions()
    {
        return $this->hasMany('App\SurveyAnswerOption');
    }
}
