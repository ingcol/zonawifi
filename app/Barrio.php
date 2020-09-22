<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    protected  $table='barrios';


	protected $fillable = ['NombreBarrio', 'DescripcionBarrio', 'EstadoBarrio'];
}
