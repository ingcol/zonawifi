<?php

namespace App\Http\Controllers;
use App\Conexion_liceo;
use App\Persona_liceo;
use Illuminate\Http\Request;

class ZonaWifiLiceoRegistrarController extends Controller
{
    //
	public function registrar(Request $request){


		$existePersona=Persona_liceo::where('documento',$request->user)->first();
		if ($existePersona) {
	
 #insert conexion

			if ($request->zone=="1" || $request->zone=="2" || $request->zone=="3" ||	$request->zone=="4" || $request->zone=="5" || $request->zone=="6") {
  	# zone 

				$conexion=new Conexion_liceo;
				$conexion->persona_liceo_id=$existePersona->id;
				$conexion->zona_liceo_id=$request->zone;
				$conexion->mac=$request->mac;
				$conexion->save();

				return response()->json(['success' => ['message' => ['Registro creado con exito']]],200);
			}

		}


	}
}
