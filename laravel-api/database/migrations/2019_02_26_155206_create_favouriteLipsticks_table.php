<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouriteLipsticksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FavouriteLipsticks', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('lipstickColor_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('Users');
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
        Schema::drop('FavouriteLipsticks');
    }
}
