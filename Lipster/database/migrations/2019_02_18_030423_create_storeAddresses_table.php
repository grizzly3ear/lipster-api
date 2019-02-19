<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StoreAddresses', function (Blueprint $table) {
          $table->increments('id');
        $table->float('latitude');
        $table->float('longtitude');
        $table->String('addressDetail');
        $table->integer('store_id')->unsigned();
        $table->foreign('store_id')->references('id')->on('Stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('StoreAddresses');
    }
}
