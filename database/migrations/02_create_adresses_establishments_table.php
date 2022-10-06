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
        Schema::create('adresses_establishments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cep', 8);
            $table->string('public_place', 150);
            $table->string('city', 150);
            $table->string('uf', 2);
            $table->string('complement', 150)->nullable();
            $table->string('reference', 150)->nullable();
            $table->integer('number_place');
            $table->integer('fk_establishments')->unsigned()->nullable();
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
        Schema::dropIfExists('adresses_establishments');
    }
};
