<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NombreUsuario');
            $table->string('ApellidoUsuario');
            $table->string('DocumentoUsuario')->unique();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('EstadoUsuario')->nullable();
            $table->string('TelefonoUsuario')->unique();
            $table->string('password');
            $table->string('GeneroUsuario');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();




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
}
