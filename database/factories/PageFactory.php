<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'menu_id' => $faker->numberBetween($min = 1, $max = 20),
        'description' => $faker->text(200),
        'slug' => $faker->unique()->colorName()
    ];
});
