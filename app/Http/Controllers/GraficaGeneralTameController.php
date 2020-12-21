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
		
		$amaDeCasa=$conexioPersona->where('OcupacionPersona','amaDeCasaPersona')->count();
		$estudiante=$conexioPersona->where('OcupacionPersona','estudiantePersona')->count();
		$desempleado=$conexioPersona->where('OcupacionPersona','desempleadoPersona')->count();

		$empleado=$conexioPersona->where('OcupacionPersona','empleadoPersona')->count();
		$empresario=$conexioPersona->where('OcupacionPersona','empresarioPersona')->count();
		$independiente=$conexioPersona->where('OcupacionPersona','independientePersona')->count();
		$otroPersona=$conexioPersona->where('OcupacionPersona','otroPersona')->count();



		//Género

		$femenino=$conexioPersona->where('GeneroPersona','Femenino')->count();
		$masculino=$conexioPersona->where('GeneroPersona','Masculino')->count();
		$otro=$conexioPersona->where('GeneroPersona','Otro')->count();
		$lgtbi=$conexioPersona->where('GeneroPersona','LGTBI')->count();

       //Por edades
		$rangoUnoEdad=$conexioPersona->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
		$rangoDosEdad=$conexioPersona->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
		$rangoTresEdad=$conexioPersona->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
		$rangoCuatroEdad=$conexioPersona->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
		$rangoCincoEdad=$conexioPersona->where('EdadPersona','>=',51)->count();

       //Poblacción

		$poblacionNinguna=$conexioPersona->where('PoblacionPersona','Ninguna')->count();
		$poblacionVictima=$conexioPersona->where('PoblacionPersona','Víctimas del conflicto armado')->count();

		$poblacionAfrocolombia=$conexioPersona->where('PoblacionPersona','Afrocolombiano')->count();
		$poblacionIndigena=$conexioPersona->where('PoblacionPersona','Comunidades indígenas')->count();
		$poblacionMayor=$conexioPersona->where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

		$barrioUno=$conexioPersona->where('BarrioPersona','Alibei')->count();
		$barrioDos=$conexioPersona->where('BarrioPersona','Acasias II')->count();

		$barrioTres=$conexioPersona->where('BarrioPersona','Bajo cusay II')->count();
		$barrioCuatro=$conexioPersona->where('BarrioPersona','Banco purare')->count();
		$barrioCinco=$conexioPersona->where('BarrioPersona','Betoyes')->count();
		$barrioSeis=$conexioPersona->where('BarrioPersona','Brisas de satena')->count();
		$barrioSiete=$conexioPersona->where('BarrioPersona','Brisas de tamacay')->count();
		$barrioOcho=$conexioPersona->where('BarrioPersona','Brisas del cravo')->count();
			//Barrio

		$barrioNueve=$conexioPersona->where('BarrioPersona','Caño limón')->count();
		$barrioDiez=$conexioPersona->where('BarrioPersona','Corocito')->count();

		$barrioDuno=$conexioPersona->where('BarrioPersona','Caño corozo')->count();
		$barrioDdos=$conexioPersona->where('BarrioPersona','El pesebre')->count();
		$barrioDtres=$conexioPersona->where('BarrioPersona','El susto')->count();
		$barrioDcuatro=$conexioPersona->where('BarrioPersona','Filipinas')->count();
		$barrioDcinco=$conexioPersona->where('BarrioPersona','La arenosa')->count();
		$barrioDseis=$conexioPersona->where('BarrioPersona','La holanda')->count();
			//Barrio

		$barrioDsiete=$conexioPersona->where('BarrioPersona','La unión')->count();
		$barrioDocho=$conexioPersona->where('BarrioPersona','Lejanías')->count();

		$barrioDnueve=$conexioPersona->where('BarrioPersona','Marquelandia')->count();
		$barrioVeinte=$conexioPersona->where('BarrioPersona','Napoles')->count();
		$barrioVuno=$conexioPersona->where('BarrioPersona','Nuevo amanecer')->count();
		$barrioVdos=$conexioPersona->where('BarrioPersona','Rincón de la esperanza')->count();
		$barrioVtres=$conexioPersona->where('BarrioPersona','Rincón hondo')->count();
		$barrioVcuatro=$conexioPersona->where('BarrioPersona','San antonio')->count();

			//Barrio

		$barrioVcinco=$conexioPersona->where('BarrioPersona','San salvador')->count();
		$barrioVseis=$conexioPersona->where('BarrioPersona','Santo domingo caserio')->count();

		$barrioVsiete=$conexioPersona->where('BarrioPersona','Saparay')->count();
		$barrioVocho=$conexioPersona->where('BarrioPersona','Vereda santo domingo')->count();

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
