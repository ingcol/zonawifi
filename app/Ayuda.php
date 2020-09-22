<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
    protected  $table='ayudas';


	protected $fillable = ['beneficiario_id', 'FechaAyuda', 'DescripcionAyuda','user_id'];
	public function beneficiario(){

        return $this->belongsTo(Beneficiario::class);
    }
    public function usuario(){

        return $this->belongsTo(User::class,'user_id');
    }

}
