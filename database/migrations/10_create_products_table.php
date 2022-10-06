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
            $table->increments('id');
            $table->integer('id_establishment');
            $table->string('desc', 80);
            $table->string('img');
            $table->double('value_und', 10,2);
            $table->decimal('value_brt', 10,2)->nullable();
            $table->decimal('value_pro', 10,2)->nullable();
            $table->boolean('sale')->nullable()->FALSE;
            $table->integer('fk_categories')->unsigned();
            $table->foreign('fk_categories')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
