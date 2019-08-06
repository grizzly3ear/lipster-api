<?php

use App\Models\LipstickImage;
use Faker\Generator as Faker;

$factory->define(LipstickImage::class, function (Faker $faker) {
    // $table->increments('id');
    //         $table->string('image');
    //         $table->integer('lipstick_color_id')->unsigned();
    //         $table->timestamps();
    $i = 0;
    return [
        'image' => $faker->imageUrl($width = 270, $height = 270, 'fashion'),
        'lipstick_color_id' => $faker->numberBetween($min = 1, $max = 40),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
