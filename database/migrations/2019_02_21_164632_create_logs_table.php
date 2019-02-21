<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Logs', function (Blueprint $table) {
          $table->increments('id');
          $table->String('action');
          $table->String('detail');
          $table->timestamps();
          $table->integer('User_id')->unsigned();
          $table->foreign('User_id')->references('id')->on('Users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Logs');
    }
}