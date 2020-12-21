<?php

namespace App\Http\Controllers;
use App\Persona;

use Illuminate\Http\Request;
use DB;
class InformeController extends Controller
{
	public function __construct()
    {
        set_time_limit(8000000);
    }

	public function index(){
		return view('informe.listado.index');
	}
	public function listadoInforme(){

		//$persona=Persona::orderBy('created_at','desc')->get();
		$persona = DB::table('personas')->orderBy('created_at','desc')->get();
		$personaCantidad=$persona->count();
		return response()->json(['persona' => $persona, 'personaCantidad' => $personaCantidad]);



	}
}
