<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona_liceo;
use App\Conexion_liceo;
use Carbon\Carbon;
use DB;

class ListadoUsuarioLiceoController extends Controller
{
    public function index(){
    	return view('listado_usuario_liceo.index');
    }

    public function  listadoUsuarioLiceo(Request $request){

        $cantidad= DB::table('persona_liceo')->get();

        $persona= DB::table('conexion_liceo')->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->selectRaw('persona_liceo.*, count(persona_liceo.id) as cantConexion,nombre_grado')->groupBy('persona_liceo.id')->get();
        $personaCantidadConectado=$persona->count();
        $personaCantidad=$cantidad->count();

        return response()->json(["persona"=>$persona,"personaCantidad"=>$personaCantidad,'personaCantidadConectado'=>$personaCantidadConectado]);


    }
    public function conexioPorUsuarioLiceo(Request $request){

    	$conexiones=DB::table('conexion_liceo')->where('persona_liceo_id',$request->idUsuario)->get();
    	return response()->json(["conexiones"=>$conexiones]);
    	//dd($request->idUsuario);

    }
}
