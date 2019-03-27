<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trend', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('year')->unsigned();
            $table->string('image');
            $table->string('skin_color');
            $table->string('lipstick_color_id')->unsigned();
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
        Schema::dropIfExists('trend');
    }
}
