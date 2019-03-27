<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('latitude');
            $table->bigInteger('longtitude');
            $table->string('address_detail');
            $table->integer('store_id')->unsigned();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_address');
    }
}
