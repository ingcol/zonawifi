<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTamezonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamezonas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NombrePersona');
            $table->bigInteger('EdadPersona')->unsigned();
            $table->string('GeneroPersona');
            $table->string('BarrioPersona');
            $table->string('PoblacionPersona');
            $table->string('EstadoPersona');
            $table->string('OcupacionPersona');
            $table->string('MacPersona')->nullable();
            
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
        Schema::dropIfExists('tamezonas');
    }
}
