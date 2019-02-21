<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LipstickImages', function (Blueprint $table) {
          $table->increments('id');
          $table->String('img');
          $table->integer('lipstickDetail_id')->unsigned();
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
        Schema::drop('LipstickImages');
    }
}
