<?php

use App\Models\LipstickColor;
use Faker\Generator as Faker;

$factory->define(LipstickColor::class, function (Faker $faker) {
    // $table->increments('id');
    //         $table->string('color_name');
    //         $table->string('rgb');
    //         $table->string('color_code');
    //         $table->integer('lipstick_detail_id')->unsigned();
    //         $table->timestamps();
    $i = 0;
    return [
        'color_name' => $faker->colorName,
        'rgb' => $faker->hexcolor,
        'color_code' => 'abc0'.$i,
        'lipstick_detail_id' => $faker->numberBetween($min = 1, $max = 10),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
