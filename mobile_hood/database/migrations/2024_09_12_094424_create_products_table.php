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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('image');
            $table->string('description');
            $table->double('price');
            $table->string('brand');
            $table->unsignedBigInteger('fk_products_categories');
            $table->foreign('fk_products_categories')->references('id')
                ->on('categories');
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['fk_products_categories']);
        });

        Schema::dropIfExists('products');
    }
};
