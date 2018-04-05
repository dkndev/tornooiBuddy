<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tournaments\Location::class, function (Faker $faker) {
    return [
        'adress' => $faker->address,
        'latitude' => $faker->latitude($min = 47, $max = 52),
        'longitude' => $faker->longitude($min = 3, $max = 6),
    ];
});
