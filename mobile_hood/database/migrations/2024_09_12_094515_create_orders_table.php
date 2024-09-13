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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->double('payment');
            $table->unsignedBigInteger('fk_orders_users');
            $table->foreign('fk_orders_users')->references('id')
                ->on('users');
            $table->timestamps();
            $table->boolean('is_active')->default(true);
        });

        Schema::create('orders_products', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_orders_products_orders');
            $table->unsignedBigInteger('fk_orders_products_products');
            $table->integer('amount');
            $table->foreign('fk_orders_products_orders')->references('id')
                ->on('orders');
            $table->foreign('fk_orders_products_products')->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_products', function (Blueprint $table) {
            $table->dropForeign(['fk_orders_products_orders']);
            $table->dropForeign(['fk_orders_products_products']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['fk_orders_users']);
        });

        Schema::dropIfExists('orders');
    }
};
