<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        'title' => $faker->colorName,
        'parent_menu_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
