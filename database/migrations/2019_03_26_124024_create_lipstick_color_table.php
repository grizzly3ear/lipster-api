<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipstickColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lipstick_color', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color_name');
            $table->string('rgb');
            $table->string('color_code');
            $table->integer('lipstick_detail_id')->unsigned();
            $table->timestamps();

            $table->foreign('lipstick_detail_id')->references('id')->on('lipstick_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lipstick_color');
    }
}
