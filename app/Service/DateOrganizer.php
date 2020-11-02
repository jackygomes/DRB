<?php
/**
 * Created by PhpStorm.
 * User: Lizard
 * Date: 10/28/2020
 * Time: 1:56 PM
 */

namespace App\Service;


use Carbon\Carbon;

class DateOrganizer
{
    public function makePrettyDate($date){
        return Carbon::parse($date)->format('d M y h:i');
    }
}