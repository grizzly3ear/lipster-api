<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreHasLipstickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_has_lipstick', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lipstick_color_id')->unsigned();
            $table->integer('store_address_id')->unsigned();
            $table->timestamps();

            $table->foreign('lipstick_color_id')->references('id')->on('lipstick_color');
            $table->foreign('store_address_id')->references('id')->on('store_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_has_lipstick');
    }
}
