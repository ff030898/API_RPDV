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
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('open')->TRUE;
            $table->integer('day_closed');
            $table->boolean('orders_tables')->TRUE;
            $table->decimal('max_withdraw', 10,2);
            $table->integer('payment_day');
            $table->time('open_time_orders');
            $table->time('closed_time_orders');
            $table->time('orders_time_limit');
            $table->integer('fk_establishments')->unsigned();
            $table->foreign('fk_establishments')->references('id')->on('establishments')->onDelete('cascade');
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
        Schema::dropIfExists('settings');
    }
};
