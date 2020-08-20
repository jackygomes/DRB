<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'ticker' => $faker->currencyCode  ,
        'sector_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
