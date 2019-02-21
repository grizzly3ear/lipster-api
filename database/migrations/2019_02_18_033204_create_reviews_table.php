<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reviews', function (Blueprint $table) {
          $table->increments('id');
          $table->string('comment');
          $table->string('skinColor');
          $table->integer('rating');
          $table->integer('User_id')->unsigned();
          $table->integer('lipstickDetail_id')->unsigned();
          $table->foreign('User_id')->references('id')->on('Users');
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
        Schema::drop('Reviews');
    }
}
