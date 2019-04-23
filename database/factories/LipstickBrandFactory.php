<?php

use App\Models\LipstickBrand;
use Faker\Generator as Faker;

$factory->define(LipstickBrand::class, function (Faker $faker) {
    $i = 0;
    return [
        'name' => $faker->company,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
