<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZonaWifiTame;
use Carbon\Carbon;
use DB;


class FiltroGeneralTameController extends Controller
{

	public function __construct()
    {
        set_time_limit(8000000);
    }

	public function index(){
		return view('filtro_tame.filtro_general.index');
	}
	public function filtroTameGeneral(Request $request){



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
			$conexioPersona=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->get();


			$femenino=DB::table('tamezonas')->where('GeneroPersona','Femenino')->count();
			$masculino=DB::table('tamezonas')->where('GeneroPersona','Masculino')->count();
			$otro=DB::table('tamezonas')->where('GeneroPersona','Otro')->count();
			$lgtbi=DB::table('tamezonas')->where('GeneroPersona','LGTBI')->count();

       //Por edades
			$rangoUnoEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();

       //Poblacción


			$poblacionNinguna=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();

       //Barrio

			$barrioUno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Alibei')->count();
			$barrioDos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Acasias II')->count();

			$barrioTres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Bajo cusay II')->count();
			$barrioCuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Banco purare')->count();
			$barrioCinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Betoyes')->count();
			$barrioSeis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Brisas de satena')->count();
			$barrioSiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Brisas de tamacay')->count();
			$barrioOcho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Brisas del cravo')->count();
			//Barrio

			$barrioNueve=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Caño limón')->count();
			$barrioDiez=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Corocito')->count();

			$barrioDuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Caño corozo')->count();
			$barrioDdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','El pesebre')->count();
			$barrioDtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','El susto')->count();
			$barrioDcuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Filipinas')->count();
			$barrioDcinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La arenosa')->count();
			$barrioDseis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La holanda')->count();
			//Barrio

			$barrioDsiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La unión')->count();
			$barrioDocho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Lejanías')->count();

			$barrioDnueve=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Marquelandia')->count();
			$barrioVeinte=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Napoles')->count();
			$barrioVuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Nuevo amanecer')->count();
			$barrioVdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Rincón de la esperanza')->count();
			$barrioVtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Rincón hondo')->count();
			$barrioVcuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San antonio')->count();

			//Barrio

			$barrioVcinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San salvador')->count();
			$barrioVseis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Santo domingo caserio')->count();

			$barrioVsiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Saparay')->count();
			$barrioVocho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Vereda santo domingo')->count();

			//Porcentaje

			$personaCount=DB::table('tamezonas')->count();


			//Horarios
			$FechaActual= Carbon::now();
			$navegacionCero=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();
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
			]);

			
		}
		elseif ($request->filtrarDatos=="2") {
			$rangoUnoEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',5)->where('EdadPersona','<=',20)->count();
			$rangoDosEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',21)->where('EdadPersona','<=',30)->count();
			$rangoTresEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',31)->where('EdadPersona','<=',40)->count();
			$rangoCuatroEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',41)->where('EdadPersona','<=',50)->count();
			$rangoCincoEdad=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('EdadPersona','>=',51)->count();
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

			$poblacionNinguna=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Ninguna')->count();
			$poblacionVictima=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Víctimas del conflicto armado')->count();

			$poblacionAfrocolombia=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Afrocolombiano')->count();
			$poblacionIndigena=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Comunidades indígenas')->count();
			$poblacionMayor=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('PoblacionPersona','Adulto mayor')->count();
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
			$barrioUno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Alibei')->count();
			$barrioDos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Acasias II')->count();

			$barrioTres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Bajo cusay II')->count();
			$barrioCuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Banco purare')->count();
			$barrioCinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Betoyes')->count();
			$barrioSeis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Brisas de satena')->count();
			$barrioSiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Brisas de tamacay')->count();
			$barrioOcho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Brisas del cravo')->count();
			//Barrio

			$barrioNueve=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Caño limón')->count();
			$barrioDiez=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Corocito')->count();

			$barrioDuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Caño corozo')->count();
			$barrioDdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','El pesebre')->count();
			$barrioDtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','El susto')->count();
			$barrioDcuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Filipinas')->count();
			$barrioDcinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La arenosa')->count();
			$barrioDseis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La holanda')->count();
			//Barrio

			$barrioDsiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','La unión')->count();
			$barrioDocho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Lejanías')->count();

			$barrioDnueve=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Marquelandia')->count();
			$barrioVeinte=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Napoles')->count();
			$barrioVuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Nuevo amanecer')->count();
			$barrioVdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Rincón de la esperanza')->count();
			$barrioVtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Rincón hondo')->count();
			$barrioVcuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San antonio')->count();

			//Barrio

			$barrioVcinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','San salvador')->count();
			$barrioVseis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Santo domingo caserio')->count();

			$barrioVsiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Saparay')->count();
			$barrioVocho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('BarrioPersona','Vereda santo domingo')->count();

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
				'barrioVocho'=>$barrioVocho
				
			]);
		}
		elseif ($request->filtrarDatos=="5") {
			$navegacionCero=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();
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
			$conexioPersona=DB::table('tamezonas')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->get();


			$femenino=DB::table('tamezonas')->where('GeneroPersona','Femenino')->count();
			$masculino=DB::table('tamezonas')->where('GeneroPersona','Masculino')->count();
			$otro=DB::table('tamezonas')->where('GeneroPersona','Otro')->count();
			$lgtbi=DB::table('tamezonas')->where('GeneroPersona','LGTBI')->count();
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
