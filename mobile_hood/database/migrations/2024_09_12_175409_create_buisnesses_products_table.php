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
        Schema::create('buisnesses_products', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_buisnesses_products_buisnesses');
            $table->foreign('fk_buisnesses_products_buisnesses')->references('id')
                ->on('buisnesses');
            $table->unsignedBigInteger('fk_buisnesses_products_products');
            $table->foreign('fk_buisnesses_products_products')->references('id')
                ->on('products');
            $table->integer('stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buisnesses_products', function (Blueprint $table) {
            $table->dropForeign(['fk_buisnesses_products_buisnesses']);
            $table->dropForeign(['fk_buisnesses_products_products']);
        });

        Schema::dropIfExists('buisnesses_products');
    }
};
