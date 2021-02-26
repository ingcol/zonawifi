<?php

namespace App\Http\Controllers;
use App\Persona;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
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
		$FechaActual= Carbon::now();

		//$persona=Persona::orderBy('created_at','desc')->get();
		$persona = DB::table('personas')->where(DB::raw('year(created_at)'),$FechaActual->format('Y'))->orderBy('created_at','desc')->get();
		$personaCantidad=$persona->count();
		return response()->json(['persona' => $persona, 'personaCantidad' => $personaCantidad]);



	}
}
