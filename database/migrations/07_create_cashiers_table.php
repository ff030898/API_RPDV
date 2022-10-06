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
        Schema::create('cashiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cashier_establishments');
            $table->boolean('open')->nullable()->TRUE;
            $table->double('initial', 10,2);
            $table->double('money', 10,2)->nullable();
            $table->double('debit', 10,2)->nullable();
            $table->double('credit', 10,2)->nullable();
            $table->double('others', 10,2)->nullable();
            $table->double('delivery_fee', 10,2)->nullable();
            $table->double('table_fee', 10,2)->nullable();
            $table->double('withdraw', 10,2)->nullable();
            $table->double('subtotal', 10,2)->nullable();
            $table->double('total', 10,2)->nullable();
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
        Schema::dropIfExists('cashiers');
    }
};
