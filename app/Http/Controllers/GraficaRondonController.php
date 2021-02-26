<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use Carbon\Carbon;
use DB;

class GraficaRondonController extends Controller
{

	public function __construct()
    {
        set_time_limit(8000000);
    }

	public function index(){

		return view('rondon.grafica.index');
	}

	
	public function graficaRondon(){

		$fechaActual = Carbon::now();
		//Consulta por año actual


		

		

		$conexioPersona=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->get();

		$totalConexion=$conexioPersona->count();
		$totalDispositivo=$conexioPersona->groupBy('MacPersona')->count();
		$totalBarrioConectado=$conexioPersona->groupBy('BarrioPersona')->count();

			//Género
		$femenino=DB::table('personas')->where('GeneroPersona','Femenino')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$masculino=DB::table('personas')->where('GeneroPersona','Masculino')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$otro=DB::table('personas')->where('GeneroPersona','Otro')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$lgtbi=DB::table('personas')->where('GeneroPersona','LGTBI')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();

			//Ocupación

		//$ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona');
		$amaDeCasa=DB::table('personas')->where('OcupacionPersona','amaDeCasa')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$estudiante=DB::table('personas')->where('OcupacionPersona','estudiante')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$desempleado=DB::table('personas')->where('OcupacionPersona','desempleado')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();

		$empleado=DB::table('personas')->where('OcupacionPersona','empleado')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$empresario=DB::table('personas')->where('OcupacionPersona','empresario')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$independiente=DB::table('personas')->where('OcupacionPersona','independiente')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();
		$otro=DB::table('personas')->where('OcupacionPersona','otro')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();



       //Por edades
		$rangoUnoEdad=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
		$rangoDosEdad=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
		$rangoTresEdad=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
		$rangoCuatroEdad=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
		$rangoCincoEdad=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('EdadPersona','>=',51)->count();

       //Poblacción


		$poblacionNinguna=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('PoblacionPersona','Ninguna')->count();
		$poblacionVictima=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('PoblacionPersona','Víctimas del conflicto armado')->count();

		$poblacionAfrocolombia=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('PoblacionPersona','Afrocolombiano')->count();
		$poblacionIndigena=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('PoblacionPersona','Comunidades indígenas')->count();
		$poblacionMayor=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

		$barrioUno=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','La floresta')->count();
		$barrioDos=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','La virgen')->count();

		$barrioTres=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','20 de enero')->count();
		$barrioCuatro=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','Flor de mi llano')->count();
		$barrioCinco=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','Barrio nuevo')->count();
		$barrioSeis=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','San ignacio')->count();
		$barrioSiete=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','Doble calzada')->count();
		$barrioOcho=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','Colegio la inmaculada')->count();
		$barrioNueve=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','Tachuelo')->count();

			//Porcentaje

		$personaCount=Persona::where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->count();


			//Horarios
		$FechaActual= Carbon::now();
		$navegacionCero=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),0)->count();


		$navegacionUno=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),1)->count();
		$navegacionDos=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),2)->count();

		$navegacionTres=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),3)->count();
		$navegacionCuatro=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),4)->count();

		$navegacionCinco=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),5)->count();
		$navegacionSeis=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),6)->count();

		$navegacionSiete=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),7)->count();
		$navegacionOcho=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),8)->count();

		$navegacionNueve=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),9)->count();
		$navegacionDiez=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),10)->count();

		$navegacionDuno=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),11)->count();
		$navegacionDdos=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),12)->count();

		$navegacionDtres=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),13)->count();
		$navegacionDcuatro=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),14)->count();

		$navegacionDquinto=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),15)->count();
		$navegacionDsexto=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),16)->count();

		$navegacionDseptimo=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),17)->count();
		$navegacionDoctavo=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),18)->count();

		$navegacionDnoveno=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),19)->count();
		$navegacionVeinte=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),20)->count();

		$navegacionVuno=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),21)->count();
		$navegacionVdos=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),22)->count();

		$navegacionVtres=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where(DB::raw('hour(created_at)'),23)->count();

		//Nacionalidad

		$colombiano=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('NacionalidadPersona','Colombiano')->count();
		

		$venezolano=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('NacionalidadPersona','Venezolano')->count();
		
		$ecuatoriano=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('NacionalidadPersona','Ecuatoriano')->count();













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
		    'otro'=>$otro,
		    'totalConexion'=>$totalConexion,
		    "totalDispositivo"=>$totalDispositivo,
		    "totalBarrioConectado"=>$totalBarrioConectado,
		    "venezolano"=>$venezolano,
		    "colombiano"=>$colombiano,
		    "ecuatoriano"=>$ecuatoriano
		]);

	}
}
