<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
     protected  $table='personas';


	protected $fillable = ['NombrePersona', 'EdadPersona', 'GeneroPersona','PoblacionPersona','BarrioPersona','EstadoPersona','OcupacionPersona','MacPersona'];
}
