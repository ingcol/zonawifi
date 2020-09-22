<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NombreBeneficiario');
            $table->string('ApellidoBeneficiario');
            $table->bigInteger('DocumentoBeneficiario')->unsigned()->unique();
            $table->bigInteger('TelefonoBeneficiario')->unsigned()->unique();
            $table->string('DireccionBeneficiario');
            $table->string('GeneroBeneficiario');
            $table->bigInteger('EdadBeneficiario')->unsigned();
            $table->bigInteger('barrio_id')->unsigned()->index();
            $table->foreign('barrio_id')->references('id')->on('barrios');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('beneficiarios');
    }
}
