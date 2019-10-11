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

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->words(2, true),
        'description' => $faker->paragraph(10, true),
        'image_url' => $faker->imageUrl(480, 640),
        'genre_id' => $faker->numberBetween($min = 1, $max = 4),
        'number_of_views' => $faker->numberBetween($min=100, $max=500),
        'number_of_likes' => $faker->numberBetween($min=10, $max=100),
        'number_of_dislikes' => $faker->numberBetween($min=10, $max=40)
    ];
});
