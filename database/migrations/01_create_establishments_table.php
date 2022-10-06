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
        Schema::create('establishments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 150);
            $table->string('email', 100)->unique();
            $table->boolean('email_verified')->nullable()->FALSE;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar', 50)->nullable();
            $table->string('cnpj', 20)->unique()->nullable();

            $table->boolean('active')->TRUE;
            $table->integer('fk_planes')->unsigned();
            $table->foreign('fk_planes')->references('id')->on('planes')->onDelete('cascade');
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
};
