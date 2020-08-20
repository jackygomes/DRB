<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends DrbModel
{
    public function surveyQuestions(){
        return $this->hasMany('App\SurveyQuestion');
    }
}
