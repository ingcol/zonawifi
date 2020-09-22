<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
     protected  $table='beneficiarios';

     protected $fillable = ['NombreBeneficiario', 'ApellidoBeneficiario', 'DocumentoBeneficiario','TelefonoBeneficiario','DireccionBeneficiario','GeneroBeneficiario','EdadBeneficiario','barrio_id','EstratoBeneficiario','user_id','CantidadAyuda'];

     public function barrio(){

		return $this->belongsTo(Barrio::class,'barrio_id');
	}
	 public function usuario(){

		return $this->belongsTo(User::class,'user_id');
	}
	  public function ayudas(){
        return $this->hasMany(Ayuda::class,'beneficiario_id');

    }
}

