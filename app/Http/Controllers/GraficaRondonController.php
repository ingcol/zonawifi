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

	public function nuevoProyecto(){
		$inicioNuevoProyecto='2021-04-08';
		return $inicioNuevoProyecto;
	}

	
	public function graficaRondon(){

		$fechaActual = Carbon::now();
		//Consulta por año actual


//$conexioPersona=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->get();

//dd($conexioPersona);
		

		

		$conexioPersona=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->get();

		$totalConexion=$conexioPersona->count();
		$totalDispositivo=$conexioPersona->groupBy('MacPersona')->count();
		$totalBarrioConectado=$conexioPersona->groupBy('BarrioPersona')->count();

			//Género
		$femenino=DB::table('personas')->where('GeneroPersona','Femenino')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$masculino=DB::table('personas')->where('GeneroPersona','Masculino')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$otro=DB::table('personas')->where('GeneroPersona','Otro')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$lgtbi=DB::table('personas')->where('GeneroPersona','LGTBI')->whereDate('created_at','>=',$this->nuevoProyecto())->count();


		$totalGenero=$femenino+$masculino+$otro+$lgtbi;

			//Ocupación

		//$ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona');
		$amaDeCasa=DB::table('personas')->where('OcupacionPersona','amaDeCasa')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$estudiante=DB::table('personas')->where('OcupacionPersona','estudiante')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$desempleado=DB::table('personas')->where('OcupacionPersona','desempleado')->whereDate('created_at','>=',$this->nuevoProyecto())->count();

		$empleado=DB::table('personas')->where('OcupacionPersona','empleado')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$empresario=DB::table('personas')->where('OcupacionPersona','empresario')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$independiente=DB::table('personas')->where('OcupacionPersona','independiente')->whereDate('created_at','>=',$this->nuevoProyecto())->count();
		$otro=DB::table('personas')->where('OcupacionPersona','otro')->whereDate('created_at','>=',$this->nuevoProyecto())->count();

		$totalOcupacion=$amaDeCasa+$estudiante+$desempleado+$empleado+$empresario+$independiente+$otro;



       //Por edades
		$rangoUnoEdad=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
		$rangoDosEdad=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
		$rangoTresEdad=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
		$rangoCuatroEdad=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
		$rangoCincoEdad=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('EdadPersona','>=',51)->count();


		$totalEdad=$rangoUnoEdad+$rangoDosEdad+$rangoTresEdad+$rangoCuatroEdad+$rangoCincoEdad;

       //Poblacción


		$poblacionNinguna=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('PoblacionPersona','Ninguna')->count();
		$poblacionVictima=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('PoblacionPersona','Víctimas del conflicto armado')->count();

		$poblacionAfrocolombia=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('PoblacionPersona','Afrocolombiano')->count();
		$poblacionIndigena=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('PoblacionPersona','Comunidades indígenas')->count();
		$poblacionMayor=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('PoblacionPersona','Adulto mayor')->count();

		$totalPoblacion=$poblacionNinguna+$poblacionVictima+$poblacionAfrocolombia+$poblacionIndigena+$poblacionMayor;

       //Barrio

		//$barrioUno=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','La floresta')->count();

		$barrioDos=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','La virgen')->count();

		$barrioTres=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','20 de enero')->count();
		//$barrioCuatro=DB::table('personas')->where(DB::raw('year(created_at)'),$fechaActual->format('Y'))->where('BarrioPersona','Flor de mi llano')->count();
		$barrioCinco=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Barrio nuevo')->count();
		$barrioSeis=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','San ignacio')->count();
		$barrioSiete=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Doble calzada')->count();
		$barrioOcho=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Colegio la inmaculada')->count();
		$barrioNueve=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Tachuelo')->count();
//Nuevos
		$barrioBiblioteca=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Biblioteca')->count();
		$barrioParaiso=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Paraiso')->count();
		$barrioCentro=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('BarrioPersona','Centro')->count();

		$totalBarrio=$barrioCentro+$barrioParaiso+$barrioBiblioteca+$barrioNueve+$barrioOcho+$barrioSiete+$barrioSeis+$barrioCinco+$barrioTres+$barrioDos;

		

			//Porcentaje

		$personaCount=Persona::whereDate('created_at','>=',$this->nuevoProyecto())->count();


			//Horarios
		$FechaActual= Carbon::now();
		$navegacionCero=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),0)->count();


		$navegacionUno=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),1)->count();
		$navegacionDos=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),2)->count();

		$navegacionTres=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),3)->count();
		$navegacionCuatro=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),4)->count();

		$navegacionCinco=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),5)->count();
		$navegacionSeis=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),6)->count();

		$navegacionSiete=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),7)->count();
		$navegacionOcho=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),8)->count();

		$navegacionNueve=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),9)->count();
		$navegacionDiez=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),10)->count();

		$navegacionDuno=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),11)->count();
		$navegacionDdos=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),12)->count();

		$navegacionDtres=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),13)->count();
		$navegacionDcuatro=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),14)->count();

		$navegacionDquinto=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),15)->count();
		$navegacionDsexto=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),16)->count();

		$navegacionDseptimo=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),17)->count();
		$navegacionDoctavo=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),18)->count();

		$navegacionDnoveno=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),19)->count();
		$navegacionVeinte=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),20)->count();

		$navegacionVuno=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),21)->count();
		$navegacionVdos=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),22)->count();

		$navegacionVtres=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where(DB::raw('hour(created_at)'),23)->count();

		$totalNavegacionHora=$navegacionCero+$navegacionUno+$navegacionDos+$navegacionTres+$navegacionCuatro+$navegacionCinco+$navegacionSeis+$navegacionSiete+$navegacionOcho+$navegacionNueve+$navegacionDiez+$navegacionDuno+$navegacionDdos+$navegacionDtres+$navegacionDcuatro+$navegacionDquinto+$navegacionDsexto+$navegacionDseptimo+$navegacionDoctavo+$navegacionDnoveno+$navegacionVeinte+$navegacionVuno+$navegacionVdos+$navegacionVtres;

		//Nacionalidad

		$colombiano=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('NacionalidadPersona','Colombiano')->count();
		

		$venezolano=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('NacionalidadPersona','Venezolano')->count();
		
		$ecuatoriano=DB::table('personas')->whereDate('created_at','>=',$this->nuevoProyecto())->where('NacionalidadPersona','Ecuatoriano')->count();
        

        $totalNacionalidad=$colombiano+$ecuatoriano+$venezolano;












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
			'barrioBiblioteca'=>$barrioBiblioteca,
			'barrioDos'=>$barrioDos,
			'barrioTres'=>$barrioTres,
			'barrioCentro'=>$barrioCentro,
			'barrioParaiso'=>$barrioParaiso,
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
		    "ecuatoriano"=>$ecuatoriano,
		    "totalGenero"=>$totalGenero,
            "totalOcupacion"=>$totalOcupacion,
            "totalEdad"=>$totalEdad,
            "totalPoblacion"=>$totalPoblacion,
            "totalNavegacionHora"=>$totalNavegacionHora,
            "totalBarrio"=>$totalBarrio,
            "totalNacionalidad"=>$totalNacionalidad,
		]);

	}
}
