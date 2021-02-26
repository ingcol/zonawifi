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
	public function filtroRondonGeneral(Request $request){



		$FechaActual= Carbon::now();

		//Validar Filtro año actual

		if ($request->fechaInicio<$FechaActual->format('Y')) {
			return response()->json(['errors' => ['message' => ['La fecha inicio debe estar en el año actual']]], 422);
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

       //Por edades
			$rangoUnoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();

       //Poblacción


			$poblacionNinguna=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

			$barrioUno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La floresta')->count();
			$barrioDos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La virgen')->count();

			$barrioTres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','20 de enero')->count();
			$barrioCuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Flor de mi llano')->count();
			$barrioCinco=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Barrio nuevo')->count();
			$barrioSeis=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San ignacio')->count();
			$barrioSiete=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Doble calzada')->count();
			$barrioOcho=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Colegio la inmaculada')->count();
			$barrioNueve=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Tachuelo')->count();

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
			]);

			
		}
		elseif ($request->filtrarDatos=="2") {
			$rangoUnoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,

				"rangoUnoEdad"=>$rangoUnoEdad,
				"rangoDosEdad"=>$rangoDosEdad,
				"rangoTresEdad"=>$rangoTresEdad,
				"rangoCuatroEdad"=>$rangoCuatroEdad,
				'rangoCincoEdad'=>$rangoCincoEdad,


			]);


		}
		elseif ($request->filtrarDatos=="3") {

			$poblacionNinguna=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'poblacionNinguna'=>$poblacionNinguna,
				'poblacionVictima'=>$poblacionVictima,
				'poblacionAfrocolombia'=>$poblacionAfrocolombia,
				'poblacionIndigena'=>$poblacionIndigena,
				'poblacionMayor'=>$poblacionMayor
				
				
			]);
			
		}
		elseif ($request->filtrarDatos=="4") {
			//Barrio
			$barrioUno=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La floresta')->count();
			$barrioDos=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La virgen')->count();

			$barrioTres=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','20 de enero')->count();
			$barrioCuatro=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Flor de mi llano')->count();
			$barrioCinco=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Barrio nuevo')->count();
			$barrioSeis=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San ignacio')->count();
			$barrioSiete=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Doble calzada')->count();
			$barrioOcho=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Colegio la inmaculada')->count();
			$barrioNueve=DB::table('personas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Tachuelo')->count();
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'barrioUno'=>$barrioUno,
				'barrioDos'=>$barrioDos,
				'barrioTres'=>$barrioTres,
				'barrioCuatro'=>$barrioCuatro,
				'barrioCinco'=>$barrioCinco,
				'barrioSeis'=>$barrioSeis,
				'barrioSiete'=>$barrioSiete,
				'barrioOcho'=>$barrioOcho,
				'barrioNueve'=>$barrioNueve
				
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
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'femenino'=>$femenino,
				'masculino'=>$masculino,
				'otro'=>$otro,
				'lgtbi'=>$lgtbi,
				
				
			]);
		}
		else{

		}

		


		


	}
}
