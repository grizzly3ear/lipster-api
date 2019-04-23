<?php

use App\Models\Trend;
use Faker\Generator as Faker;

$factory->define(Trend::class, function (Faker $faker) {
    // $table->increments('id');
    //         $table->string('title');
    //         $table->integer('year')->unsigned();
    //         $table->string('image');
    //         $table->string('skin_color');
    //         $table->integer('lipstick_color_id')->unsigned();
    //         $table->timestamps();
    $i = 0;
    return [
        'title' => $faker->firstNameMale,
        'year' => $faker->numberBetween($min = 2016, $max = 2019),
        'image' => $faker->imageUrl($width = 270, $height = 270, 'cats'),
        'skin_color' => $faker->hexColor,
        'lipstick_color_id' => $faker->numberBetween($min = 1, $max = 40),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
