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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->integer('fk_orders')->unsigned();
            $table->integer('fk_products')->unsigned();
            $table->double('qtd', 10,2);
            $table->double('value', 10,2);
            $table->double('total', 10,2);
            $table->primary(['fk_orders', 'fk_products']);

            $table->foreign('fk_orders')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('fk_products')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_items');
    }
};
