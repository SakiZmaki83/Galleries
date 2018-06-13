<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) 
{
    return [
        'gallery_name' => $faker->firstName,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'user_id' => $faker->numberBetween($min = 1, $max = 10)
    ];
});
