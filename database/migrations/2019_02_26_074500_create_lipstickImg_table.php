<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickImgTable extends Migration
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
          $table->String('image');
          $table->integer('lipstickColour_id')->unsigned();
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
        Schema::drop('LipstickImages');
    }
}
