<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop\Products\Product;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;


$factory->define(Product::class, function (Faker $faker) {

    $product = $faker->unique()->sentence;
    $file = UploadedFile::fake()->image('product.png', 600, 600);
    return [
        'sku' => $this->faker->numberBetween(1111111, 999999),
        'name' => $product,
        'slug' => Str::slug($product),
        'description' => $this->faker->paragraph,
        'cover' => $file->store('products', ['disk' => 'public']),
        'quantity' => 10,
        'price' => 5.00,
        'status' => 1,
    ];
});
