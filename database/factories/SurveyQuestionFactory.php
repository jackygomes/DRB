<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\SurveyQuestion::class, function (Faker $faker) {
    return [
        'survey_id' => $faker->numberBetween($min = 1, $max = 20),
        'question' => $faker->text(100),
    ];
});
