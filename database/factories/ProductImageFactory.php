<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop\Products\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'url' => $faker->url,
    ];
});
