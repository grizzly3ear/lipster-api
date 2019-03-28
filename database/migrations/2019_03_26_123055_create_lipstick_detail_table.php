<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('lipstick_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('max_price')->unsigned();
            $table->double('min_price')->unsigned();
            $table->string('type');
            $table->double('opacity')->unsigned();
            $table->string('description');
            $table->string('composition');
            $table->string('apply');
            $table->integer('lipstick_brand_id')->unsigned();
            $table->timestamps();

            $table->foreign('lipstick_brand_id')->references('id')->on('lipstick_brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lipstick_detail');
    }
}
