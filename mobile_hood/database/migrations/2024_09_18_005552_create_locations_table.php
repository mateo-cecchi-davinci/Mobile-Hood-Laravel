<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->float('lat', 10, 7);
            $table->float('lng', 10, 7);
            $table->unsignedBigInteger('fk_locations_buisnesses')->unique();
            $table->foreign('fk_locations_buisnesses')->references('id')->on('buisnesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['fk_locations_buisnesses']);
        });

        Schema::dropIfExists('locations');
    }
};
