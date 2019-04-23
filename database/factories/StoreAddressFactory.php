<?php

use App\Models\StoreAddress;
use Faker\Generator as Faker;

$factory->define(StoreAddress::class, function (Faker $faker) {
    // $table->increments('id');
    //         $table->bigInteger('latitude');
    //         $table->bigInteger('longtitude');
    //         $table->string('address_detail');
    //         $table->integer('store_id')->unsigned();
    //         $table->timestamps();
    $i = 0;
    return [
        'latitude' => $faker->biasedNumberBetween($min = 30, $max = 140, $function = 'sqrt'),
        'longtitude' => $faker->biasedNumberBetween($min = 30, $max = 140, $function = 'sqrt'),
        'address_detail' => $faker->address,
        'store_id' => ++$i,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
