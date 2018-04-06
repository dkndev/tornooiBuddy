<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tournaments\Location::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'latitude' => $faker->latitude($min = 50.3, $max = 51.2),
        'longitude' => $faker->longitude($min = 3.5, $max = 5.6),
    ];
});
