<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use Carbon\Carbon;
use DB;

class GraficaRondonController extends Controller
{
	public function index(){

		return view('rondon.grafica.index');
	}

	public function datosRondon(){

		$fechaActual = Carbon::now();

		$Persona=Persona::get();
		$totalConexion=Persona::count();
		$totalDispositivo=$Persona->groupBy('MacPersona')->count();
		$totalBarrioConectado=$Persona->groupBy('BarrioPersona')->count();
		return response()->json(['totalConexion'=>$totalConexion,"totalDispositivo"=>$totalDispositivo,"totalBarrioConectado"=>$totalBarrioConectado]);
	}
	public function graficaRondon(){

		$fechaActual = Carbon::now();
		
		

		

		$conexioPersona=Persona::get();

			//Género
		$femenino=$conexioPersona->where('GeneroPersona','Femenino')->count();
		$masculino=$conexioPersona->where('GeneroPersona','Masculino')->count();
		$otro=$conexioPersona->where('GeneroPersona','Otro')->count();
		$lgtbi=$conexioPersona->where('GeneroPersona','LGTBI')->count();

			//Ocupación

		$ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona');
		$amaDeCasa=$conexioPersona->where('OcupacionPersona','amaDeCasa')->count();
		$estudiante=$conexioPersona->where('OcupacionPersona','estudiante')->count();
		$desempleado=$conexioPersona->where('OcupacionPersona','desempleado')->count();

		$empleado=$conexioPersona->where('OcupacionPersona','empleado')->count();
		$empresario=$conexioPersona->where('OcupacionPersona','empresario')->count();
		$independiente=$conexioPersona->where('OcupacionPersona','independiente')->count();
		$otro=$conexioPersona->where('OcupacionPersona','otro')->count();



       //Por edades
		$rangoUnoEdad=Persona::where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
		$rangoDosEdad=Persona::where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
		$rangoTresEdad=Persona::where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
		$rangoCuatroEdad=Persona::where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
		$rangoCincoEdad=Persona::where('EdadPersona','>=',51)->count();

       //Poblacción


		$poblacionNinguna=Persona::where('PoblacionPersona','Ninguna')->count();
		$poblacionVictima=Persona::where('PoblacionPersona','Víctimas del conflicto armado')->count();

		$poblacionAfrocolombia=Persona::where('PoblacionPersona','Afrocolombiano')->count();
		$poblacionIndigena=Persona::where('PoblacionPersona','Comunidades indígenas')->count();
		$poblacionMayor=Persona::where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

		$barrioUno=Persona::where('BarrioPersona','La floresta')->count();
		$barrioDos=Persona::where('BarrioPersona','La virgen')->count();

		$barrioTres=Persona::where('BarrioPersona','20 de enero')->count();
		$barrioCuatro=Persona::where('BarrioPersona','Flor de mi llano')->count();
		$barrioCinco=Persona::where('BarrioPersona','Barrio nuevo')->count();
		$barrioSeis=Persona::where('BarrioPersona','San ignacio')->count();
		$barrioSiete=Persona::where('BarrioPersona','Doble calzada')->count();
		$barrioOcho=Persona::where('BarrioPersona','Colegio la inmaculada')->count();

			//Porcentaje

		$personaCount=Persona::count();


			//Horarios
		$FechaActual= Carbon::now();
		$navegacionCero=Persona::where(DB::raw('hour(created_at)'),0)->count();


		$navegacionUno=Persona::where(DB::raw('hour(created_at)'),1)->count();
		$navegacionDos=Persona::where(DB::raw('hour(created_at)'),2)->count();

		$navegacionTres=Persona::where(DB::raw('hour(created_at)'),3)->count();
		$navegacionCuatro=Persona::where(DB::raw('hour(created_at)'),4)->count();

		$navegacionCinco=Persona::where(DB::raw('hour(created_at)'),5)->count();
		$navegacionSeis=Persona::where(DB::raw('hour(created_at)'),6)->count();

		$navegacionSiete=Persona::where(DB::raw('hour(created_at)'),7)->count();
		$navegacionOcho=Persona::where(DB::raw('hour(created_at)'),8)->count();

		$navegacionNueve=Persona::where(DB::raw('hour(created_at)'),9)->count();
		$navegacionDiez=Persona::where(DB::raw('hour(created_at)'),10)->count();

		$navegacionDuno=Persona::where(DB::raw('hour(created_at)'),11)->count();
		$navegacionDdos=Persona::where(DB::raw('hour(created_at)'),12)->count();

		$navegacionDtres=Persona::where(DB::raw('hour(created_at)'),13)->count();
		$navegacionDcuatro=Persona::where(DB::raw('hour(created_at)'),14)->count();

		$navegacionDquinto=Persona::where(DB::raw('hour(created_at)'),15)->count();
		$navegacionDsexto=Persona::where(DB::raw('hour(created_at)'),16)->count();

		$navegacionDseptimo=Persona::where(DB::raw('hour(created_at)'),17)->count();
		$navegacionDoctavo=Persona::where(DB::raw('hour(created_at)'),18)->count();

		$navegacionDnoveno=Persona::where(DB::raw('hour(created_at)'),19)->count();
		$navegacionVeinte=Persona::where(DB::raw('hour(created_at)'),20)->count();

		$navegacionVuno=Persona::where(DB::raw('hour(created_at)'),21)->count();
		$navegacionVdos=Persona::where(DB::raw('hour(created_at)'),22)->count();

		$navegacionVtres=Persona::where(DB::raw('hour(created_at)'),23)->count();













		return response()->json([
			'femenino'=>$femenino,
			'masculino'=>$masculino,
			'otro'=>$otro,
			'lgtbi'=>$lgtbi,
			"rangoUnoEdad"=>$rangoUnoEdad,
			"rangoDosEdad"=>$rangoDosEdad,
			"rangoTresEdad"=>$rangoTresEdad,
			"rangoCuatroEdad"=>$rangoCuatroEdad,
			'rangoCincoEdad'=>$rangoCincoEdad,
			'poblacionNinguna'=>$poblacionNinguna,
			'poblacionVictima'=>$poblacionVictima,
			'poblacionAfrocolombia'=>$poblacionAfrocolombia,
			'poblacionIndigena'=>$poblacionIndigena,
			'poblacionMayor'=>$poblacionMayor,
			'barrioUno'=>$barrioUno,
			'barrioDos'=>$barrioDos,
			'barrioTres'=>$barrioTres,
			'barrioCuatro'=>$barrioCuatro,
			'barrioCinco'=>$barrioCinco,
			'barrioSeis'=>$barrioSeis,
			'barrioSiete'=>$barrioSiete,
			'barrioOcho'=>$barrioOcho,
			'navegacionCero'=>$navegacionCero,
			'navegacionUno'=>$navegacionUno,
			'navegacionDos'=>$navegacionDos,
			'navegacionTres'=>$navegacionTres,
			'navegacionCuatro'=>$navegacionCuatro,
			'navegacionCinco'=>$navegacionCinco,
			'navegacionSeis'=>$navegacionSeis,
			'navegacionSiete'=>$navegacionSiete,
			'navegacionOcho'=>$navegacionOcho,
			'navegacionNueve'=>$navegacionNueve,
			'navegacionDiez'=>$navegacionDiez,
			'navegacionDuno'=>$navegacionDuno,
			'navegacionDdos'=>$navegacionDdos,
			'navegacionDtres'=>$navegacionDtres,
			'navegacionDcuatro'=>$navegacionDcuatro,
			'navegacionDquinto'=>$navegacionDquinto,
			'navegacionDsexto'=>$navegacionDsexto,
			'navegacionDseptimo'=>$navegacionDseptimo,
			'navegacionDoctavo'=>$navegacionDoctavo,
			'navegacionDnoveno'=>$navegacionDnoveno,
			'navegacionVeinte'=>$navegacionVeinte,
			'navegacionVuno'=>$navegacionVuno,
			'navegacionVdos'=>$navegacionVdos,
			'navegacionVtres'=>$navegacionVtres,
			'amaDeCasa'=>$amaDeCasa,
		    'estudiante'=>$estudiante,
		    'desempleado'=>$desempleado,
            'empleado'=>$empleado,
		    'empresario'=>$empresario,
		    'independiente'=>$independiente,
		    'otro'=>$otro
		]);

	}
}
