<?php

namespace App\Http\Controllers;
use App\Persona;

use Illuminate\Http\Request;

class InformeController extends Controller
{
	public function index(){
		return view('informe.listado.index');
	}
	public function listadoInforme(){

		$persona=Persona::orderBy('created_at','desc')->get();
		$personaCantidad=$persona->count();
		return response()->json(['persona' => $persona, 'personaCantidad' => $personaCantidad]);



	}
}
