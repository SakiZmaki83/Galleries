<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'images' => $faker->imageUrl($width = 640, $height = 480),
        'gallery_id' => $faker->numberBetween($min = 1, $max =25)
    ];
});
