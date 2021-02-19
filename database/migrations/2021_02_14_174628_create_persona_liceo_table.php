<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaLiceoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_liceo', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->bigInteger('documento')->unsigned()->unique();
            $table->bigInteger('grado_id')->unsigned()->index()->nullable();
            $table->foreign('grado_id')->references('id')->on('grado_liceo');
            $table->string('genero')->nullable();
            $table->bigInteger('edad')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('persona_liceo');
    }
}
