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
          $table->String('img');
          $table->String('skinColor');
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
        Schema::drop('Trends');
    }
}
