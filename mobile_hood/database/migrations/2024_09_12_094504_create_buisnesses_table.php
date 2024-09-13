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
        Schema::create('buisnesses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('logo', 255);
            $table->string('street', 255);
            $table->integer('number');
            $table->string('category', 255);
            $table->unsignedBigInteger('fk_buisnesses_users');
            $table->foreign('fk_buisnesses_users')->references('id')
                ->on('users');
            $table->timestamps();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buisnesses', function (Blueprint $table) {
            $table->dropForeign(['fk_buisnesses_users']);
        });

        Schema::dropIfExists('buisnesses');
    }
};
