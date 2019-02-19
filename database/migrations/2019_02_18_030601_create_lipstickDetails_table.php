<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickDetailsTable extends Migration
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
          $table->String('brand');
          $table->String('name');
          $table->double('price');
          $table->String('type');
          $table->Integer('opacity');
          $table->String('moreDetail');
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
