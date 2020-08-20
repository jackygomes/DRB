<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\SubscriptionPlan::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city(),
        'price' =>  $faker->numberBetween($min = 1000, $max = 2000),
        'duration_in_days' =>  $faker->numberBetween($min = 10, $max = 200),
    ];
});
