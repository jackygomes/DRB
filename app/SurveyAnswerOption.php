<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswerOption extends DrbModel
{
    protected $appends = ['hit_percent'];

    public function getHitPercentAttribute(){
        $answers = $this->surveyQuestion->surveyAnswerOptions;
        $total_hit = 0;
        foreach($answers as $answer){
            $total_hit += $answer->hit_count;
        }
        if($total_hit == 0){
            return $total_hit;
        }
        return ($this->hit_count/$total_hit)*100;
    }
    public function surveyQuestion()
    {
        return $this->belongsTo('App\SurveyQuestion');
    }


}
