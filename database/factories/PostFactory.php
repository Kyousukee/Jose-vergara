<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,3),
        'image' => $faker->imageUrl($width=1000, $height = 400),
        'tittle' => $faker->sentence(3),
        'description' => $faker->text(100),
        'ubication' => $faker->text(5),
        
    ];
});
