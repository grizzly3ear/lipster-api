<?php

use App\Models\TrendGroup;
use Faker\Generator as Faker;

$factory->define(TrendGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
        'image'=> $faker->imageUrl($width = 270, $height = 270, 'fashion'),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
