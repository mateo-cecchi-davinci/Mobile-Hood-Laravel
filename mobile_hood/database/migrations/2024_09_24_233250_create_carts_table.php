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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_carts_users');
            $table->foreign('fk_carts_users')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_carts_products');
            $table->foreign('fk_carts_products')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['fk_carts_users']);
            $table->dropForeign(['fk_carts_products']);
        });
        Schema::dropIfExists('carts');
    }
};
