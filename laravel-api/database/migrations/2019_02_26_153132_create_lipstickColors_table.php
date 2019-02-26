<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LipstickColors', function (Blueprint $table) {
          $table->increments('id');
          $table->String('colorName');
          $table->String('RGB-HSL');
          $table->String('colorCode');
          $table->integer('lipstickDetail_id')->unsigned();
          $table->foreign('lipstickDetail_id')->references('id')->on('LipstickDetails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('LipstickColors');
    }
}
