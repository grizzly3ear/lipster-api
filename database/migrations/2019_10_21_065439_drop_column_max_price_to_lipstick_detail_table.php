<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnMaxPriceToLipstickDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lipstick_detail', function (Blueprint $table) {
            $table->dropColumn('max_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lipstick_detail', function (Blueprint $table) {
            $table->double('max_price')->unsigned();
        });
    }
}
