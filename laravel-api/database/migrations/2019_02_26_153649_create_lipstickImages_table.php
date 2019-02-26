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
          $table->String('image');
          $table->integer('lipstickColor_id')->unsigned();
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
        Schema::drop('LipstickImages');
    }
}
