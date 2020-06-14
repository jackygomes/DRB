<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\SurveyAnswerOption::class, function (Faker $faker) {
    return [
        'survey_question_id' => $faker->numberBetween($min = 1, $max = 20),
        'answer_option' => $faker->text(100),
        'hit_count' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
