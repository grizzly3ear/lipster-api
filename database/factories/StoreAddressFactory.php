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
    $lat = [
        13.6523027,13.6473896,13.6529562, 13.6490919
    ];
    $long = [
        100.4973744, 100.4968444, 100.4970162, 100.4964104
    ];
    return [
        'latitude' => $lat[$faker->numberBetween($min = 0, $max = count($lat)-1)],
        'longtitude' => $long[$faker->numberBetween($min = 0, $max = count($long)-1)],
        'address_detail' => $faker->address,
        'store_id' => ++$i,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
