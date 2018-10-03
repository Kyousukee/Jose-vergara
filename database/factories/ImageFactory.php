<?php

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'post_id' => rand(1,10),
        'tittle' => $faker->sentence(3),
        'url' => $faker->sentence(1)
    ];
});
