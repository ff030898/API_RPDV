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
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_establishment');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('cpf')->nullable();
            $table->string('phone', 11)->unique();
            $table->boolean('active')->TRUE;
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
        Schema::dropIfExists('clients');
    }
};
