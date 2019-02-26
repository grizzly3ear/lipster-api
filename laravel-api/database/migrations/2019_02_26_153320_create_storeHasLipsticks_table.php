<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreHasLipsticksTable extends Migration
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
          $table->integer('lipstickColor_id')->unsigned();
          $table->foreign('storeAddress_id')->references('id')->on('StoreAddresses');
          $table->foreign('lipstickColor_id')->references('id')->on('LipstickColors');
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
