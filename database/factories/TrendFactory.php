<?php

use App\Models\Trend;
use Faker\Generator as Faker;

$factory->define(Trend::class, function (Faker $faker) {
    $i = 0;
    return [
        'title' => $faker->firstNameMale,
        'image' => $faker->imageUrl($width = 270, $height = 270, 'fashion'),
        'skin_color' => $faker->hexColor,
        'lipstick_color' => $faker->hexcolor,
        'trend_group_id' => $faker->numberBetween($min = 1, $max = 10),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
