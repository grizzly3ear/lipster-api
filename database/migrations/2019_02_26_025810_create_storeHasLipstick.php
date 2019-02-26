<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreHasLipstick extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StoreHasLipsticks', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('storeAddress_id')->unsigned();
          $table->integer('lipstickColour_id')->unsigned();
          $table->foreign('storeAddress_id')->references('id')->on('StoreAddresses');
          $table->foreign('lipstickColour_id')->references('id')->on('LipstickColours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('StoreHasLipsticks');
    }
}
