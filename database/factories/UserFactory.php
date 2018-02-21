<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


// Create fake Products
// 1-   product name    => sentence
// 2-   product slug    => product name slug
// 3-   product price   => a number between $100 to $1000
// 4-   description     => a paragraph
// 5-   product image   => a fixed path to book.png image
$factory->define(App\Product::class, function(Faker $faker) {
    $title = $faker->sentence(3);
    $slug  = str_slug($title);

    return [
        'name'      => $title,
        'slug'      => $slug,
        'price'     => $faker->numberBetween(100, 1000),
        'description' => $faker->paragraph(4),
        'image'     => 'uploads/products/book.png'
    ];
});