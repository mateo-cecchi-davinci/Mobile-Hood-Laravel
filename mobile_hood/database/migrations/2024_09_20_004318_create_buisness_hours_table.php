<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buisness_hours', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('day_of_week');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->unsignedBigInteger('fk_buisness_hours_buisness');
            $table->foreign('fk_buisness_hours_buisness')->references('id')->on('buisnesses')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE buisness_hours ADD CONSTRAINT chk_day_of_week CHECK (day_of_week BETWEEN 0 AND 6)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE buisness_hours DROP CONSTRAINT chk_day_of_week');

        Schema::table('buisness_hours', function (Blueprint $table) {
            $table->dropForeign('fk_buisness_hours_buisness');
        });

        Schema::dropIfExists('buisness_hours');
    }
};
