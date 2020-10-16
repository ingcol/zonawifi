<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZonaWifiTame;
use Carbon\Carbon;
use DB;

class GraficaGeneralTameController extends Controller
{
	public function index(){

		return view('tame.grafica_general.index');
	}

	public function datosTameGeneral(){

		$fechaActual = Carbon::now();

		$Persona=ZonaWifiTame::get();
		$totalConexion=ZonaWifiTame::count();
		$totalDispositivo=$Persona->groupBy('MacPersona')->count();
		$totalBarrioConectado=$Persona->groupBy('BarrioPersona')->count();
		return response()->json(['totalConexion'=>$totalConexion,"totalDispositivo"=>$totalDispositivo,"totalBarrioConectado"=>$totalBarrioConectado]);
	}
	public function graficaGeneralTame(){

		$fechaActual = Carbon::now();
		
		$conexioPersona=ZonaWifiTame::get();
    
		
//Ocupación
		$ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona');
		$amaDeCasa=$conexioPersona->where('OcupacionPersona','amaDeCasa')->count();
		$estudiante=$conexioPersona->where('OcupacionPersona','estudiante')->count();
		$desempleado=$conexioPersona->where('OcupacionPersona','desempleado')->count();

		$empleado=$conexioPersona->where('OcupacionPersona','empleado')->count();
		$empresario=$conexioPersona->where('OcupacionPersona','empresario')->count();
		$independiente=$conexioPersona->where('OcupacionPersona','independiente')->count();
		$otro=$conexioPersona->where('OcupacionPersona','otro')->count();


		//Género

		$femenino=$conexioPersona->where('GeneroPersona','Femenino')->count();
		$masculino=$conexioPersona->where('GeneroPersona','Masculino')->count();
		$otro=$conexioPersona->where('GeneroPersona','Otro')->count();
		$lgtbi=$conexioPersona->where('GeneroPersona','LGTBI')->count();

       //Por edades
		$rangoUnoEdad=ZonaWifiTame::where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
		$rangoDosEdad=ZonaWifiTame::where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
		$rangoTresEdad=ZonaWifiTame::where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
		$rangoCuatroEdad=ZonaWifiTame::where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
		$rangoCincoEdad=ZonaWifiTame::where('EdadPersona','>=',51)->count();

       //Poblacción

		$poblacionNinguna=ZonaWifiTame::where('PoblacionPersona','Ninguna')->count();
		$poblacionVictima=ZonaWifiTame::where('PoblacionPersona','Víctimas del conflicto armado')->count();

		$poblacionAfrocolombia=ZonaWifiTame::where('PoblacionPersona','Afrocolombiano')->count();
		$poblacionIndigena=ZonaWifiTame::where('PoblacionPersona','Comunidades indígenas')->count();
		$poblacionMayor=ZonaWifiTame::where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

		$barrioUno=ZonaWifiTame::where('BarrioPersona','Alibei')->count();
		$barrioDos=ZonaWifiTame::where('BarrioPersona','Acasias II')->count();

		$barrioTres=ZonaWifiTame::where('BarrioPersona','Bajo cusay II')->count();
		$barrioCuatro=ZonaWifiTame::where('BarrioPersona','Banco purare')->count();
		$barrioCinco=ZonaWifiTame::where('BarrioPersona','Betoyes')->count();
		$barrioSeis=ZonaWifiTame::where('BarrioPersona','Brisas de satena')->count();
		$barrioSiete=ZonaWifiTame::where('BarrioPersona','Brisas de tamacay')->count();
		$barrioOcho=ZonaWifiTame::where('BarrioPersona','Brisas del cravo')->count();
			//Barrio

		$barrioNueve=ZonaWifiTame::where('BarrioPersona','Caño limón')->count();
		$barrioDiez=ZonaWifiTame::where('BarrioPersona','Corocito')->count();

		$barrioDuno=ZonaWifiTame::where('BarrioPersona','Caño corozo')->count();
		$barrioDdos=ZonaWifiTame::where('BarrioPersona','El pesebre')->count();
		$barrioDtres=ZonaWifiTame::where('BarrioPersona','El susto')->count();
		$barrioDcuatro=ZonaWifiTame::where('BarrioPersona','Filipinas')->count();
		$barrioDcinco=ZonaWifiTame::where('BarrioPersona','La arenosa')->count();
		$barrioDseis=ZonaWifiTame::where('BarrioPersona','La holanda')->count();
			//Barrio

		$barrioDsiete=ZonaWifiTame::where('BarrioPersona','La unión')->count();
		$barrioDocho=ZonaWifiTame::where('BarrioPersona','Lejanías')->count();

		$barrioDnueve=ZonaWifiTame::where('BarrioPersona','Marquelandia')->count();
		$barrioVeinte=ZonaWifiTame::where('BarrioPersona','Napoles')->count();
		$barrioVuno=ZonaWifiTame::where('BarrioPersona','Nuevo amanecer')->count();
		$barrioVdos=ZonaWifiTame::where('BarrioPersona','Rincón de la esperanza')->count();
		$barrioVtres=ZonaWifiTame::where('BarrioPersona','Rincón hondo')->count();
		$barrioVcuatro=ZonaWifiTame::where('BarrioPersona','San antonio')->count();

			//Barrio

		$barrioVcinco=ZonaWifiTame::where('BarrioPersona','San salvador')->count();
		$barrioVseis=ZonaWifiTame::where('BarrioPersona','Santo domingo caserio')->count();

		$barrioVsiete=ZonaWifiTame::where('BarrioPersona','Saparay')->count();
		$barrioVocho=ZonaWifiTame::where('BarrioPersona','Vereda santo domingo')->count();

		//Porcentaje

		$personaCount=ZonaWifiTame::count();


		//Horarios
		$FechaActual= Carbon::now();
		$navegacionCero=ZonaWifiTame::where(DB::raw('hour(created_at)'),0)->count();


		$navegacionUno=ZonaWifiTame::where(DB::raw('hour(created_at)'),1)->count();
		$navegacionDos=ZonaWifiTame::where(DB::raw('hour(created_at)'),2)->count();

		$navegacionTres=ZonaWifiTame::where(DB::raw('hour(created_at)'),3)->count();
		$navegacionCuatro=ZonaWifiTame::where(DB::raw('hour(created_at)'),4)->count();

		$navegacionCinco=ZonaWifiTame::where(DB::raw('hour(created_at)'),5)->count();
		$navegacionSeis=ZonaWifiTame::where(DB::raw('hour(created_at)'),6)->count();

		$navegacionSiete=ZonaWifiTame::where(DB::raw('hour(created_at)'),7)->count();
		$navegacionOcho=ZonaWifiTame::where(DB::raw('hour(created_at)'),8)->count();

		$navegacionNueve=ZonaWifiTame::where(DB::raw('hour(created_at)'),9)->count();
		$navegacionDiez=ZonaWifiTame::where(DB::raw('hour(created_at)'),10)->count();

		$navegacionDuno=ZonaWifiTame::where(DB::raw('hour(created_at)'),11)->count();
		$navegacionDdos=ZonaWifiTame::where(DB::raw('hour(created_at)'),12)->count();

		$navegacionDtres=ZonaWifiTame::where(DB::raw('hour(created_at)'),13)->count();
		$navegacionDcuatro=ZonaWifiTame::where(DB::raw('hour(created_at)'),14)->count();

		$navegacionDquinto=ZonaWifiTame::where(DB::raw('hour(created_at)'),15)->count();
		$navegacionDsexto=ZonaWifiTame::where(DB::raw('hour(created_at)'),16)->count();

		$navegacionDseptimo=ZonaWifiTame::where(DB::raw('hour(created_at)'),17)->count();
		$navegacionDoctavo=ZonaWifiTame::where(DB::raw('hour(created_at)'),18)->count();

		$navegacionDnoveno=ZonaWifiTame::where(DB::raw('hour(created_at)'),19)->count();
		$navegacionVeinte=ZonaWifiTame::where(DB::raw('hour(created_at)'),20)->count();

		$navegacionVuno=ZonaWifiTame::where(DB::raw('hour(created_at)'),21)->count();
		$navegacionVdos=ZonaWifiTame::where(DB::raw('hour(created_at)'),22)->count();

		$navegacionVtres=ZonaWifiTame::where(DB::raw('hour(created_at)'),23)->count();




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
			'barrioNueve'=>$barrioNueve,
			'barrioDiez'=>$barrioDiez,
			'barrioDuno'=>$barrioDuno,
			'barrioDdos'=>$barrioDdos,
			'barrioDtres'=>$barrioDtres,
			'barrioDcuatro'=>$barrioDcuatro,
			'barrioDcinco'=>$barrioDcinco,
			'barrioDseis'=>$barrioDseis,
			'barrioDsiete'=>$barrioDsiete,
			'barrioDocho'=>$barrioDocho,
			'barrioDnueve'=>$barrioDnueve,
			'barrioVeinte'=>$barrioVeinte,
			'barrioVuno'=>$barrioVuno,
			'barrioVdos'=>$barrioVdos,
			'barrioVtres'=>$barrioVtres,
			'barrioVcuatro'=>$barrioVcuatro,
			'barrioVcinco'=>$barrioVcinco,
			'barrioVseis'=>$barrioVseis,
			'barrioVsiete'=>$barrioVsiete,
			'barrioVocho'=>$barrioVocho,
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
