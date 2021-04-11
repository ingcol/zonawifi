<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use Carbon\Carbon;
use DB;

class FiltroGeneralRondonController extends Controller
{
	public function __construct()
	{
		set_time_limit(8000000);
	}

	public function index(){
		return view('filtro_rondon.filtro_general.index');
	}
	public function nuevoProyecto(){
		$inicioNuevoProyecto='2021-04-08';
		return $inicioNuevoProyecto;
	}
	public function filtroRondonGeneral(Request $request){



		$FechaActual= Carbon::now();

		//Validar Filtro año actual

		if ($request->fechaInicio<$this->nuevoProyecto()) {
			return response()->json(['errors' => ['message' => ['La fecha inicial debe ser mayor a 7 de abril del 2021']]], 422);
		}
    // Validar fechas
		if ($request->fechaInicio>$FechaActual->format('Y-m-d')) {
			return response()->json(['errors' => ['message' => ['La fecha inicial no debe ser mayor a la fecha actual']]], 422);
		}
		if ($request->fechaFin>$FechaActual->format('Y-m-d')) {
			return response()->json(['errors' => ['message' => ['La fecha final no debe ser mayor a la fecha actual']]], 422);
		}

		if (!empty($request->fechaInicio) &&  empty($request->fechaFin)) {
			return response()->json(['errors' => ['message' => ['Debe ingresar una fecha final']]], 422);
		}
		if (empty($request->fechaInicio) &&  !empty($request->fechaFin)) {
			return response()->json(['errors' => ['message' => ['Debe ingresar una fecha inicial']]], 422);
		}
		if ($request->fechaInicio>$request->fechaFin) {
			return response()->json(['errors' => ['message' => ['La fecha inicial no debe ser mayor a la fecha final']]], 422);
		}
		if (empty($request->filtrarDatos)) {
			return response()->json(['errors' => ['message' => ['Seleccione una opción para el filtro']]], 422);
		}

		if ($request->filtrarDatos=="1") {
			//Por género
			$conexioPersona=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->get();


			$femenino=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','Femenino')->count();
			$masculino=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','Masculino')->count();
			$otro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','Otro')->count();
			$lgtbi=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','LGTBI')->count();
			$totalGenero=$femenino+$masculino+$otro+$lgtbi;

       //Por edades
			$rangoUnoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();

			$totalEdad=$rangoUnoEdad+$rangoDosEdad+$rangoTresEdad+$rangoCuatroEdad+$rangoCincoEdad;

       //Poblacción


			$poblacionNinguna=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();


			$totalPoblacion=$poblacionNinguna+$poblacionVictima+$poblacionAfrocolombia+$poblacionIndigena+$poblacionMayor;

       //Barrio
			/*

			$barrioUno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La floresta')->count();

			*/
			$barrioDos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La virgen')->count();

			$barrioTres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','20 de enero')->count();
			/*

			$barrioCuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Flor de mi llano')->count();
			*/
			$barrioCinco=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Barrio nuevo')->count();
			$barrioSeis=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San ignacio')->count();
			$barrioSiete=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Doble calzada')->count();
			$barrioOcho=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Colegio la inmaculada')->count();
			$barrioNueve=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Tachuelo')->count();

			$barrioBiblioteca=DB::table('personas')->where('BarrioPersona','Biblioteca')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->count();
			$barrioParaiso=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Paraiso')->count();
			$barrioCentro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Centro')->count();

			$totalBarrio=$barrioCentro+$barrioParaiso+$barrioBiblioteca+$barrioNueve+$barrioOcho+$barrioSiete+$barrioSeis+$barrioCinco+$barrioTres+$barrioDos;

			//Porcentaje

			$personaCount=Persona::count();


			//Horarios
			$FechaActual= Carbon::now();
			$navegacionCero=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();

			$totalNavegacionHora=$navegacionCero+$navegacionUno+$navegacionDos+$navegacionTres+$navegacionCuatro+$navegacionCinco+$navegacionSeis+$navegacionSiete+$navegacionOcho+$navegacionNueve+$navegacionDiez+$navegacionDuno+$navegacionDdos+$navegacionDtres+$navegacionDcuatro+$navegacionDquinto+$navegacionDsexto+$navegacionDseptimo+$navegacionDoctavo+$navegacionDnoveno+$navegacionVeinte+$navegacionVuno+$navegacionVdos+$navegacionVtres;

			//Ocupaciones

			//$ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona');
			$amaDeCasa=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','amaDeCasa')->count();

			$estudiante=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','estudiante')->count();

			$desempleado=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','desempleado')->count();

			$empleado=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','empleado')->count();

			$empresario=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','empresario')->count();

			$independiente=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','independiente')->count();
			$otraOcupacion=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','otro')->count();

			$totalOcupacion=$amaDeCasa+$estudiante+$desempleado+$empleado+$empresario+$independiente+$otraOcupacion;

			$colombiano=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('NacionalidadPersona','Colombiano')->count();


			$venezolano=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('NacionalidadPersona','Venezolano')->count();

			$ecuatoriano=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('NacionalidadPersona','Ecuatoriano')->count();


			$totalNacionalidad=$colombiano+$ecuatoriano+$venezolano;




			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
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
				'otraOcupacion'=>$otraOcupacion,
				"venezolano"=>$venezolano,
				"colombiano"=>$colombiano,
				"ecuatoriano"=>$ecuatoriano,
				'totalOcupacion'=>$totalOcupacion,
				'totalNacionalidad'=>$totalNacionalidad,
				'totalBarrio'=>$totalBarrio,
				'totalGenero'=>$totalGenero,
				'totalPoblacion'=>$totalPoblacion,
				'totalNavegacionHora'=>$totalNavegacionHora,
				'totalEdad'=>$totalEdad
			]);

			
		}
		elseif ($request->filtrarDatos=="2") {
			$rangoUnoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();

			$totalEdad=$rangoUnoEdad+$rangoDosEdad+$rangoTresEdad+$rangoCuatroEdad+$rangoCincoEdad;
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,

				"rangoUnoEdad"=>$rangoUnoEdad,
				"rangoDosEdad"=>$rangoDosEdad,
				"rangoTresEdad"=>$rangoTresEdad,
				"rangoCuatroEdad"=>$rangoCuatroEdad,
				'rangoCincoEdad'=>$rangoCincoEdad,
				'totalEdad'=>$totalEdad


			]);


		}
		elseif ($request->filtrarDatos=="3") {

			$poblacionNinguna=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();
			$totalPoblacion=$poblacionNinguna+$poblacionVictima+$poblacionAfrocolombia+$poblacionIndigena+$poblacionMayor;
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'poblacionNinguna'=>$poblacionNinguna,
				'poblacionVictima'=>$poblacionVictima,
				'poblacionAfrocolombia'=>$poblacionAfrocolombia,
				'poblacionIndigena'=>$poblacionIndigena,
				'poblacionMayor'=>$poblacionMayor,
				'totalPoblacion'=>$totalPoblacion
				
				
			]);
			
		}
		elseif ($request->filtrarDatos=="4") {
			//Barrio

			$barrioDos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La virgen')->count();

			$barrioTres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','20 de enero')->count();
			/*

			$barrioCuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Flor de mi llano')->count();
			*/
			$barrioCinco=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Barrio nuevo')->count();
			$barrioSeis=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San ignacio')->count();
			$barrioSiete=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Doble calzada')->count();
			$barrioOcho=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Colegio la inmaculada')->count();
			$barrioNueve=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Tachuelo')->count();

			$barrioBiblioteca=DB::table('personas')->where('BarrioPersona','Biblioteca')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->count();
			$barrioParaiso=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Paraiso')->count();
			$barrioCentro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Centro')->count();

			$totalBarrio=$barrioCentro+$barrioParaiso+$barrioBiblioteca+$barrioNueve+$barrioOcho+$barrioSiete+$barrioSeis+$barrioCinco+$barrioTres+$barrioDos;
			
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
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
				'totalBarrio'=>$totalBarrio
				
			]);
		}
		elseif ($request->filtrarDatos=="5") {
			$navegacionCero=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();

			$totalNavegacionHora=$navegacionCero+$navegacionUno+$navegacionDos+$navegacionTres+$navegacionCuatro+$navegacionCinco+$navegacionSeis+$navegacionSiete+$navegacionOcho+$navegacionNueve+$navegacionDiez+$navegacionDuno+$navegacionDdos+$navegacionDtres+$navegacionDcuatro+$navegacionDquinto+$navegacionDsexto+$navegacionDseptimo+$navegacionDoctavo+$navegacionDnoveno+$navegacionVeinte+$navegacionVuno+$navegacionVdos+$navegacionVtres;
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
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
				'totalNavegacionHora'=>$totalNavegacionHora
			]);
		}
		elseif ($request->filtrarDatos=="6") {
			# genero
				//Por género
			$conexioPersona=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->get();


			$femenino=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','Femenino')->count();
			$masculino=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','Masculino')->count();
			$otro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','Otro')->count();
			$lgtbi=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('GeneroPersona','LGTBI')->count();
			$totalGenero=$femenino+$masculino+$otro+$lgtbi;
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'femenino'=>$femenino,
				'masculino'=>$masculino,
				'otro'=>$otro,
				'lgtbi'=>$lgtbi,
				'totalGenero'=>$totalGenero
				
				
			]);
		}
		elseif ($request->filtrarDatos=="7") {
			//Nacionalidad
			$colombiano=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('NacionalidadPersona','Colombiano')->count();


			$venezolano=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('NacionalidadPersona','Venezolano')->count();

			$ecuatoriano=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('NacionalidadPersona','Ecuatoriano')->count();


			$totalNacionalidad=$colombiano+$ecuatoriano+$venezolano;
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'colombiano'=>$colombiano,
				'venezolano'=>$venezolano,
				'ecuatoriano'=>$ecuatoriano,
				'totalNacionalidad'=>$totalNacionalidad,
				
				
			]);
		}
		else{
			//$ocupacionTotal=$conexioPersona->groupBy('OcupacionPersona');
			$amaDeCasa=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','amaDeCasa')->count();

			$estudiante=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','estudiante')->count();

			$desempleado=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','desempleado')->count();

			$empleado=DB::table('personas')->where('OcupacionPersona','empleado')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->count();

			$empresario=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','empresario')->count();

			$independiente=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','independiente')->count();

			$otraOcupacion=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('OcupacionPersona','otro')->count();

			$totalOcupacion=$amaDeCasa+$estudiante+$desempleado+$empleado+$empresario+$independiente+$otraOcupacion;
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'amaDeCasa'=>$amaDeCasa,
				'estudiante'=>$estudiante,
				'desempleado'=>$desempleado,
				'empleado'=>$empleado,
				'empresario'=>$empresario,
				'independiente'=>$independiente,
				'otraOcupacion'=>$otraOcupacion,
				'totalOcupacion'=>$totalOcupacion
			]);

		}

		


		


	}
}
