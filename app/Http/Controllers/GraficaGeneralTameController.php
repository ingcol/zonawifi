<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZonaWifiTame;
use Carbon\Carbon;
use DB;

class GraficaGeneralTameController extends Controller
{

	public function __construct()
    {
        set_time_limit(8000000);
    }

	public function index(){

		return view('tame.grafica_general.index');
	}

	
	public function graficaGeneralTame(){

		$fechaActual = Carbon::now();
		
		$conexioPersona=DB::table('tamezonas')->get();
		//return($ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona'));


		
		$totalConexion=$conexioPersona->count();
		$totalDispositivo=$conexioPersona->groupBy('MacPersona')->count();
		$totalBarrioConectado=$conexioPersona->groupBy('BarrioPersona')->count();
    
		
//Ocupación
		
		$amaDeCasa=DB::table('tamezonas')->where('OcupacionPersona','amaDeCasa')->count();
		$estudiante=DB::table('tamezonas')->where('OcupacionPersona','estudiante')->count();
		$desempleado=DB::table('tamezonas')->where('OcupacionPersona','desempleado')->count();

		$empleado=DB::table('tamezonas')->where('OcupacionPersona','empleado')->count();
		$empresario=DB::table('tamezonas')->where('OcupacionPersona','empresario')->count();
		$independiente=DB::table('tamezonas')->where('OcupacionPersona','independientePersona')->count();
		$otroPersona=DB::table('tamezonas')->where('OcupacionPersona','otro')->count();



		//Género

		$femenino=DB::table('tamezonas')->where('GeneroPersona','Femenino')->count();
		$masculino=DB::table('tamezonas')->where('GeneroPersona','Masculino')->count();
		$otro=DB::table('tamezonas')->where('GeneroPersona','Otro')->count();
		$lgtbi=DB::table('tamezonas')->where('GeneroPersona','LGTBI')->count();

       //Por edades
		$rangoUnoEdad=DB::table('tamezonas')->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
		$rangoDosEdad=DB::table('tamezonas')->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
		$rangoTresEdad=DB::table('tamezonas')->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
		$rangoCuatroEdad=DB::table('tamezonas')->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
		$rangoCincoEdad=DB::table('tamezonas')->where('EdadPersona','>=',51)->count();

       //Poblacción

		$poblacionNinguna=DB::table('tamezonas')->where('PoblacionPersona','Ninguna')->count();
		$poblacionVictima=DB::table('tamezonas')->where('PoblacionPersona','Víctimas del conflicto armado')->count();

		$poblacionAfrocolombia=DB::table('tamezonas')->where('PoblacionPersona','Afrocolombiano')->count();
		$poblacionIndigena=DB::table('tamezonas')->where('PoblacionPersona','Comunidades indígenas')->count();
		$poblacionMayor=DB::table('tamezonas')->where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

		$barrioUno=DB::table('tamezonas')->where('BarrioPersona','Alibei')->count();
		$barrioDos=DB::table('tamezonas')->where('BarrioPersona','Acasias II')->count();

		$barrioTres=DB::table('tamezonas')->where('BarrioPersona','Bajo cusay II')->count();
		$barrioCuatro=DB::table('tamezonas')->where('BarrioPersona','Banco purare')->count();
		$barrioCinco=DB::table('tamezonas')->where('BarrioPersona','Betoyes')->count();
		$barrioSeis=DB::table('tamezonas')->where('BarrioPersona','Brisas de satena')->count();
		$barrioSiete=DB::table('tamezonas')->where('BarrioPersona','Brisas de tamacay')->count();
		$barrioOcho=DB::table('tamezonas')->where('BarrioPersona','Brisas del cravo')->count();
			//Barrio

		$barrioNueve=DB::table('tamezonas')->where('BarrioPersona','Caño limón')->count();
		$barrioDiez=DB::table('tamezonas')->where('BarrioPersona','Corocito')->count();

		$barrioDuno=DB::table('tamezonas')->where('BarrioPersona','Caño corozo')->count();
		$barrioDdos=DB::table('tamezonas')->where('BarrioPersona','El pesebre')->count();
		$barrioDtres=DB::table('tamezonas')->where('BarrioPersona','El susto')->count();
		$barrioDcuatro=DB::table('tamezonas')->where('BarrioPersona','Filipinas')->count();
		$barrioDcinco=DB::table('tamezonas')->where('BarrioPersona','La arenosa')->count();
		$barrioDseis=DB::table('tamezonas')->where('BarrioPersona','La holanda')->count();
			//Barrio

		$barrioDsiete=DB::table('tamezonas')->where('BarrioPersona','La unión')->count();
		$barrioDocho=DB::table('tamezonas')->where('BarrioPersona','Lejanías')->count();

		$barrioDnueve=DB::table('tamezonas')->where('BarrioPersona','Marquelandia')->count();
		$barrioVeinte=DB::table('tamezonas')->where('BarrioPersona','Napoles')->count();
		$barrioVuno=DB::table('tamezonas')->where('BarrioPersona','Nuevo amanecer')->count();
		$barrioVdos=DB::table('tamezonas')->where('BarrioPersona','Rincón de la esperanza')->count();
		$barrioVtres=DB::table('tamezonas')->where('BarrioPersona','Rincón hondo')->count();
		$barrioVcuatro=DB::table('tamezonas')->where('BarrioPersona','San antonio')->count();

			//Barrio

		$barrioVcinco=DB::table('tamezonas')->where('BarrioPersona','San salvador')->count();
		$barrioVseis=DB::table('tamezonas')->where('BarrioPersona','Santo domingo caserio')->count();

		$barrioVsiete=DB::table('tamezonas')->where('BarrioPersona','Saparay')->count();
		$barrioVocho=DB::table('tamezonas')->where('BarrioPersona','Vereda santo domingo')->count();

		//Porcentaje

		$personaCount=$conexioPersona->count();


		//Horarios
		$FechaActual= Carbon::now();
		$navegacionCero=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),0)->count();


		$navegacionUno=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),1)->count();
		$navegacionDos=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),2)->count();

		$navegacionTres=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),3)->count();
		$navegacionCuatro=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),4)->count();

		$navegacionCinco=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),5)->count();
		$navegacionSeis=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),6)->count();

		$navegacionSiete=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),7)->count();
		$navegacionOcho=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),8)->count();

		$navegacionNueve=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),9)->count();
		$navegacionDiez=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),10)->count();

		$navegacionDuno=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),11)->count();
		$navegacionDdos=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),12)->count();

		$navegacionDtres=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),13)->count();
		$navegacionDcuatro=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),14)->count();

		$navegacionDquinto=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),15)->count();
		$navegacionDsexto=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),16)->count();

		$navegacionDseptimo=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),17)->count();
		$navegacionDoctavo=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),18)->count();

		$navegacionDnoveno=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),19)->count();
		$navegacionVeinte=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),20)->count();

		$navegacionVuno=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),21)->count();
		$navegacionVdos=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),22)->count();

		$navegacionVtres=DB::table('tamezonas')->where(DB::raw('hour(created_at)'),23)->count();




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
		    'otroPersona'=>$otroPersona,
		    'totalConexion'=>$totalConexion,
		    "totalDispositivo"=>$totalDispositivo,
		    "totalBarrioConectado"=>$totalBarrioConectado
		]);

	}
}
