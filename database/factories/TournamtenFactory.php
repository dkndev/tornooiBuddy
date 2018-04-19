<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tournaments\Tournament::class, function (Faker $faker) {

    $startDate = "2018-" . rand(1,12) . '-' . rand(1,31);
    $endDate =  new DateTime($startDate);
    $endDate->modify('+1 day');

    return [
        'name' => 'tornooi ' . $faker->catchPhrase,
        'location_id' => rand(1, 20),
        'contact_id' => rand(1, 5),
        'type_id' => rand(1, 3),
        'date_start' => $startDate,
        'date_end' => $endDate,
    ];
});
