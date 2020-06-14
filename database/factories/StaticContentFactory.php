<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\StaticContent::class, function (Faker $faker) {
    return [
        'value' => $faker->text(100),
        'key' => $faker->unique()->colorName()
    ];
});
