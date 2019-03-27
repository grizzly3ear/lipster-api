<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment')->nullable();
            $table->string('skin_color')->nullable();
            $table->integer('rating');
            $table->integer('user_id')->unsigned();
            $table->integer('lipstick_color_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('lipstick_color_id')->references('id')->on('lipstick_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}
