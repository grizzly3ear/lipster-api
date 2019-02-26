<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LipstickDetails', function (Blueprint $table) {
          $table->increments('id');
          $table->String('name');
          $table->double('price');
          $table->String('type');
          $table->Integer('opacity');
          $table->String('moreDetail');
          $table->integer('lipstickBrand_id')->unsigned();
          $table->foreign('lipstickBrand_id')->references('id')->on('LipstickBrands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('LipstickDetails');
    }
}
