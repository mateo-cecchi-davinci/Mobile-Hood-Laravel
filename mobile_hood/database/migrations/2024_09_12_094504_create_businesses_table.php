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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('logo', 255);
            $table->string('street', 255);
            $table->integer('number');
            $table->string('category', 255);
            $table->unsignedBigInteger('fk_businesses_users');
            $table->foreign('fk_businesses_users')->references('id')
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
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign(['fk_businesses_users']);
        });

        Schema::dropIfExists('businesses');
    }
};
