<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnLipstickColorIdToTrendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trend', function (Blueprint $table) {
            $table->dropForeign('trend_lipstick_color_id_foreign');
            $table->dropColumn('lipstick_color_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trend', function (Blueprint $table) {
            $table->integer('lipstick_color_id')->unsigned();

            $table->foreign('lipstick_color_id')->references('id')->on('lipstick_color')->onDelete('cascade');
        });
    }
}
