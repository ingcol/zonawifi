<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConexionLiceoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conexion_liceo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('persona_liceo_id')->unsigned()->index();
            $table->foreign('persona_liceo_id')->references('id')->on('persona_liceo');
            $table->bigInteger('zona_liceo_id')->unsigned()->nullable()->index();
            $table->foreign('zona_liceo_id')->references('id')->on('zona_liceo');
            $table->string('mac')->nullable();
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
        Schema::dropIfExists('conexion_liceo');
    }
}
