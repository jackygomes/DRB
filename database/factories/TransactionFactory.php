<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'amount' => $faker->numberBetween($min = 1000, $max = 20000),
        'subscription_plan_id' => $faker->numberBetween($min = 1, $max = 2),
        'subscription_starts_at' => $faker->dateTime,
        'subscription_ends_at' => $faker->dateTime,
    ];
});
