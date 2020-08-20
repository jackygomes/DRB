<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\PageItem::class, function (Faker $faker) {
    return [
        'particular' => $faker->text(100),
        'excel_file_url' => 'https://file-examples.com/wp-content/uploads/2017/02/file_example_XLS_10.xls',
        'pdf_file_url' => 'http://www.africau.edu/images/default/sample.pdf',
        'excel_file_url_download_count' => $faker->numberBetween($min = 1, $max = 20),
        'pdf_file_url_download_count' => $faker->numberBetween($min = 1, $max = 20),
        'page_id' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
