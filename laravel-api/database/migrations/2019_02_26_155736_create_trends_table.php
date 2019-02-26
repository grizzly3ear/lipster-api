<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Trends', function (Blueprint $table) {
          $table->increments('id');
          $table->String('image');
          $table->String('skinColor');
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
        Schema::drop('Trends');
    }
}
