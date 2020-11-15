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
			$conexioPersona=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->get();


			$femenino=$conexioPersona->where('GeneroPersona','Femenino')->count();
			$masculino=$conexioPersona->where('GeneroPersona','Masculino')->count();
			$otro=$conexioPersona->where('GeneroPersona','Otro')->count();
			$lgtbi=$conexioPersona->where('GeneroPersona','LGTBI')->count();

       //Por edades
			$rangoUnoEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();

       //Poblacción


			$poblacionNinguna=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

			$barrioUno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La floresta')->count();
			$barrioDos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La virgen')->count();

			$barrioTres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','20 de enero')->count();
			$barrioCuatro=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Flor de mi llano')->count();
			$barrioCinco=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Barrio nuevo')->count();
			$barrioSeis=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San ignacio')->count();
			$barrioSiete=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Doble calzada')->count();
			$barrioOcho=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Colegio la inmaculada')->count();
			$barrioNueve=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Tachuelo')->count();

			//Porcentaje

			$personaCount=Persona::count();


			//Horarios
			$FechaActual= Carbon::now();
			$navegacionCero=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();
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
			$rangoUnoEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();
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

			$poblacionNinguna=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();
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
			$barrioUno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La floresta')->count();
			$barrioDos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La virgen')->count();

			$barrioTres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','20 de enero')->count();
			$barrioCuatro=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Flor de mi llano')->count();
			$barrioCinco=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Barrio nuevo')->count();
			$barrioSeis=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San ignacio')->count();
			$barrioSiete=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Doble calzada')->count();
			$barrioOcho=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Colegio la inmaculada')->count();
			$barrioNueve=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Tachuelo')->count();
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


			$navegacionUno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();
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
			$conexioPersona=Persona::whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->get();


			$femenino=$conexioPersona->where('GeneroPersona','Femenino')->count();
			$masculino=$conexioPersona->where('GeneroPersona','Masculino')->count();
			$otro=$conexioPersona->where('GeneroPersona','Otro')->count();
			$lgtbi=$conexioPersona->where('GeneroPersona','LGTBI')->count();
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
