<?php

use App\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    $id = 0;
    return [
        'name' => $faker->firstNameFemale,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
