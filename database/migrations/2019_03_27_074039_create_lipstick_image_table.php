<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lipstick_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->integer('lipstick_color_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('lipstick_image');
    }
}
