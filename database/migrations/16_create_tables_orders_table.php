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
        Schema::create('tables_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->boolean('open');
            $table->integer('fk_establishments')->unsigned();
            $table->foreign('fk_establishments')->references('id')->on('establishments')->onDelete('cascade');
            $table->integer('fk_orders')->unsigned();
            $table->foreign('fk_orders')->references('id')->on('orders')->onDelete('cascade');

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
        Schema::dropIfExists('tables_orders_tables');
    }
};
