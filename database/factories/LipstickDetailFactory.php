<?php

use App\Models\LipstickDetail;
use Faker\Generator as Faker;

$factory->define(LipstickDetail::class, function (Faker $faker) {
    // $table->increments('id');
    //         $table->string('name');
    //         $table->double('max_price')->unsigned();
    //         $table->double('min_price')->unsigned();
    //         $table->string('type');
    //         $table->double('opacity')->unsigned();
    //         $table->string('description');
    //         $table->string('composition');
    //         $table->string('apply');
    //         $table->integer('lipstick_brand_id')->unsigned();
    //         $table->timestamps();
    $i = 0;
    return [
        'name' => $faker->companySuffix,
        'max_price' => $faker->numberBetween($min = 2000, $max = 3000),
        'min_price' => $faker->numberBetween($min = 1000, $max = 1500),
        'type' => 'tint',
        'opacity' => $faker->biasedNumberBetween($min = 0, $max = 1, $function = 'sqrt'),
        'description' => $faker->text($maxNbChars = 20),
        'composition' => $faker->text($maxNbChars = 5),
        'apply' => $faker->text($maxNbChars = 5),
        'lipstick_brand_id' => $faker->numberBetween($min = 1, $max = 5),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
