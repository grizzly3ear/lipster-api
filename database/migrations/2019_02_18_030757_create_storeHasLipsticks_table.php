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
            $table->integer('store_id')->unsigned();
            $table->integer('lipstickDetail_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('Stores');
            $table->foreign('lipstickDetail_id')->references('id')->on('lipstickdetails');
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
