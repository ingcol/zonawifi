<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZonaWifiTame;

class ListadoConexionTameController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
    }

    public function index(){

    	return view('tame.listado.index');

    }
    public function listadoConexiones(Request $request){
    	

		$persona=ZonaWifiTame::orderBy('created_at','desc')->get();
		$personaCantidad=$persona->count();
		return response()->json(['persona' => $persona, 'personaCantidad' => $personaCantidad]);



	

    }
}
