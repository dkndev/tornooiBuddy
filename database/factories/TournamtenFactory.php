<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tournaments\Tournament::class, function (Faker $faker) {
    return [
        'name'  => 'tornooi ' . $faker->catchPhrase,
        'location_id' => rand(1, 20),
        'contact_id' => rand(1, 5),
        'type_id' => rand(1, 3),
        'date_start' => $faker->date($format = 'Y-m-d'),
        'date_end' => $faker->date($format = 'Y-m-d'),
    ];
});
