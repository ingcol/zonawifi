<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Ayuda;
use App\Beneficiario;
use App\Empresa;
use App\Turno;
use App\Persona;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      return view('home');
  }
  public function beneficiario(){

   $fechaActual = Carbon::now();

   $Persona=Persona::get();
   $totalConexion=Persona::count();
   $totalDispositivo=$Persona->groupBy('MacPersona')->count();
   $totalBarrioConectado=$Persona->groupBy('BarrioPersona')->count();
   return response()->json(['totalConexion'=>$totalConexion,"totalDispositivo"=>$totalDispositivo,"totalBarrioConectado"=>$totalBarrioConectado]);
}
public function graficanual(){
    $fechaActual = Carbon::now();
    $anioActual=$fechaActual->format('Y');
    $meses=['Enero','Febrero', 'Marzo', 'Abril', 'Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    $m=1;
    $personas=[];
    foreach($meses as $mes){
       array_push($personas, Persona::where(DB::raw('MONTH(created_at)'), '=', $m)->where(DB::raw('YEAR(created_at)'),$anioActual)->count());
       $m++;}
       $generos=['Femenino','Masculino','LGTBI','Otro'];

       
       $conexioPersona=Persona::get();
       $femenino=$conexioPersona->where('GeneroPersona','Femenino')->count();
       $masculino=$conexioPersona->where('GeneroPersona','Masculino')->count();
       $otro=$conexioPersona->where('GeneroPersona','Otro')->count();
       $lgtbi=$conexioPersona->where('GeneroPersona','LGTBI')->count();


       $cantidadGenero=[$femenino,$masculino,$lgtbi,$otro];


       return response()->json(['meses' => $meses, 'personas' => $personas,'generos'=>$generos,'cantidadGenero'=>$cantidadGenero]);
   }
}
