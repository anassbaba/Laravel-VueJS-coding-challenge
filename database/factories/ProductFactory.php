<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'image' => $faker->imageUrl($width=800, $height=400,'cats', true, 'Anass Baba'),
        'description' => $faker->paragraph(2)
    ];
});
