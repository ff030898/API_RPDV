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
            $table->increments('id');
            $table->integer('id_establishment');
            $table->string('status', 20);
            $table->boolean('payment')->FALSE;
            $table->string('payment_type', 20);
            $table->string('description', 80)->nullable();
            $table->double('subtotal', 10,2);
            $table->double('rate', 10,2)->nullable();
            $table->double('discount', 10,2)->nullable();
            //Taxa adicional
            $table->double('rate_extra', 10,2)->nullable();
            //Valor pago
            $table->double('paid', 10,2);
            //TROCO
            $table->double('change', 10,2);
            $table->double('total', 10,2);
            $table->string('type', 20);
            $table->string('deliveryman', 80);
            $table->integer('fk_cashiers')->unsigned();
            $table->foreign('fk_cashiers')->references('id')->on('cashiers')->onDelete('cascade');
            $table->integer('fk_clients')->unsigned();
            $table->foreign('fk_clients')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
