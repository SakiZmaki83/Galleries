<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10 ),
        'gallery_id' => $faker->numberBetween($min = 1, $max = 25 ),
        'comment' => $faker->sentence($nbWords = 5, $varianleNbWords = true )
    ];
});
