<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tournaments\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mail' => $faker->email,
        'phone' => $faker->e164PhoneNumber,
    ];
});
