<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password','contact_number','profession','institution'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscriptionplans()
    {
        return $this->belongsToMany('App\SubscriptionPlan');
    }
    public function canSubmitResponse(SurveyQuestion $question){
        $hit = SurveyHit::where('user_id', $this->id)->where('survey_question_id', $question->id)->first();
        if($hit == null){
            return true;
        }else{
            return false;
        }
    }
    public function subscribers()
    {
        return $this->hasMany('App\Subscriber');
    }

    public function download()
    {
        return $this->hasOne('App\Download','user_id');
    }

    public function canDownload(){
        if($this->download == null){
            return true;
        }else{
           if($this->download->how_many_left != 0){
               return true;
           }else{
               return false;
            //    if($this->subscribers->last() != null){
            //         if($this->subscribers->last()->is_expire == null){
            //             return true;
            //         }else{
            //             return false;
            //         }
            //    }else{
            //        return false;
            //    }
           }
        }
    }

    public function isSubscriber()
    {
        if($this->subscribers->last() != null){
            if($this->subscribers->last()->is_expire == null){
                return true;
            }else{
                return false;
            }
       }else{
           return false;
       }
    }
}