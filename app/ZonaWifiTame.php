<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonaWifiTame extends Model
{
     protected  $table='tamezonas';


	protected $fillable = ['NombrePersona', 'EdadPersona', 'GeneroPersona','PoblacionPersona','BarrioPersona','EstadoPersona','OcupacionPersona','MacPersona'];
}
