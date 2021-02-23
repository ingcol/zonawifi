<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona_liceo;
use App\Conexion_liceo;
use Carbon\Carbon;
use DB;

class FiltroGeneralLiceoController extends Controller
{
	public function __construct()
	{
		set_time_limit(8000000);
	}

	public function index(){
		return view('home_liceo.index');
	}


	public function  filtroGeneralLiceoDatos(){


		$conexion=DB::table('conexion_liceo')->get();
		$totalConexion=$conexion->count();
		$totalDispositivo=$conexion->groupBy('mac')->count();

		return response()->json(['totalConexion' =>$totalConexion,'totalDispositivo' =>$totalDispositivo]);


	}

	public function filtroGeneralLiceo(Request $request){
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

		//Filtros

		//todos

//Grados

		if ($request->filtrarDatos=="2") {

			$gradoPrimero=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Primero')->count();

			$gradoSegundo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Segundo')->count();

			$gradoTercero=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Tercero')->count();

			$gradoCuarto=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Cuarto')->count();

			$gradoQuinto=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Quinto')->count();

			$gradoSexto=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Sexto')->count();


			$gradoSeptimo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Septimo')->count();


			$gradoOctavo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Octavo')->count();

			$gradoNoveno=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Noveno')->count();

			$gradoDecimo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Decimo')->count();

			$gradoOnce=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Once')->count();



			$totalGrado=$gradoPrimero+$gradoSegundo+$gradoTercero+$gradoCuarto+$gradoQuinto+$gradoSexto+$gradoSeptimo+$gradoOctavo+$gradoNoveno+$gradoDecimo+$gradoOnce;



			return response()->json([

				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'gradoPrimero'=>$gradoPrimero,
				'gradoSegundo'=>$gradoSegundo,
				'gradoTercero'=>$gradoTercero,
				'gradoCuarto'=>$gradoCuarto,
				'gradoQuinto'=>$gradoQuinto,
				'gradoSexto'=>$gradoSexto,
				'gradoSeptimo'=>$gradoSeptimo,
				'gradoOctavo'=>$gradoOctavo,
				'gradoNoveno'=>$gradoNoveno,
				'gradoDecimo'=>$gradoDecimo,
				'gradoOnce'=>$gradoOnce,
				'totalGrado'=>$totalGrado
			]);
		}
		elseif ($request->filtrarDatos=="4") {
			
			$zonaUno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',1)->count();
			$zonaDos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',2)->count();

			$zonaTres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',3)->count();
			$zonaCuatro=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',4)->count();
			$zonaCinco=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',5)->count();
			$zonaSeis=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',6)->count();

			$totalZona=$zonaUno+$zonaDos+$zonaTres+$zonaCuatro+$zonaCinco+$zonaSeis;
			
			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'zonaUno'=>$zonaUno,
				'zonaDos'=>$zonaDos,
				'zonaTres'=>$zonaTres,
				'zonaCuatro'=>$zonaCuatro,
				'zonaCinco'=>$zonaCinco,
				'zonaSeis'=>$zonaSeis,
				'totalZona'=>$totalZona
				
			]);
		}

		//Horario
		elseif ($request->filtrarDatos=="5") {

			$navegacionCero=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();

			$totalNavegacionHora=$navegacionCero+$navegacionUno+$navegacionDos+$navegacionTres+$navegacionCuatro+$navegacionCinco+$navegacionSeis+$navegacionSiete+$navegacionOcho+$navegacionNueve+$navegacionDiez+$navegacionDuno+$navegacionDdos+$navegacionDtres+$navegacionDcuatro+$navegacionDquinto+$navegacionDsexto+$navegacionDseptimo+$navegacionDoctavo+$navegacionDnoveno+$navegacionVeinte+$navegacionVuno+$navegacionVdos+$navegacionVtres;
			return response()->json(['filtro'=>$request->filtrarDatos,
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
			

			$femenino=DB::table('conexion_liceo')->join('persona_liceo','conexion_liceo.persona_liceo_id','=','persona_liceo.id')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->where('persona_liceo.genero','Femenino')->count();

			$masculino=DB::table('conexion_liceo')->join('persona_liceo','conexion_liceo.persona_liceo_id','=','persona_liceo.id')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->where('persona_liceo.genero','Masculino')->count();
			$totalGenero= $masculino+$femenino;

			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'femenino'=>$femenino,
				'masculino'=>$masculino,
				'totalGenero'=>$totalGenero,
				
				
				
			]);
		}
		else{

			$gradoPrimero=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Primero')->count();

			$gradoSegundo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Segundo')->count();

			$gradoTercero=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Tercero')->count();

			$gradoCuarto=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Cuarto')->count();

			$gradoQuinto=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Quinto')->count();

			$gradoSexto=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Sexto')->count();


			$gradoSeptimo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Septimo')->count();


			$gradoOctavo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Octavo')->count();

			$gradoNoveno=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Noveno')->count();

			$gradoDecimo=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Decimo')->count();

			$gradoOnce=DB::table('conexion_liceo')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->leftJoin('persona_liceo', 'persona_liceo.id', '=', 'conexion_liceo.persona_liceo_id')->leftJoin('grado_liceo', 'grado_liceo.id', '=', 'persona_liceo.grado_id')->where('grado_liceo.nombre_grado','Once')->count();



			$totalGrado=$gradoPrimero+$gradoSegundo+$gradoTercero+$gradoCuarto+$gradoQuinto+$gradoSexto+$gradoSeptimo+$gradoOctavo+$gradoNoveno+$gradoDecimo+$gradoOnce;
			$zonaUno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',1)->count();
			$zonaDos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',2)->count();

			$zonaTres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',3)->count();
			$zonaCuatro=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',4)->count();
			$zonaCinco=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',5)->count();
			$zonaSeis=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where('zona_liceo_id',6)->count();

			$totalZona=$zonaUno+$zonaDos+$zonaTres+$zonaCuatro+$zonaCinco+$zonaSeis;

			$navegacionCero=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),0)->count();


			$navegacionUno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),1)->count();
			$navegacionDos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),2)->count();

			$navegacionTres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),3)->count();
			$navegacionCuatro=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),4)->count();

			$navegacionCinco=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),5)->count();
			$navegacionSeis=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),6)->count();

			$navegacionSiete=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),7)->count();
			$navegacionOcho=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),8)->count();

			$navegacionNueve=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),9)->count();
			$navegacionDiez=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),10)->count();

			$navegacionDuno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),11)->count();
			$navegacionDdos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),12)->count();

			$navegacionDtres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),13)->count();
			$navegacionDcuatro=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),14)->count();

			$navegacionDquinto=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),15)->count();
			$navegacionDsexto=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),16)->count();

			$navegacionDseptimo=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),17)->count();
			$navegacionDoctavo=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),18)->count();

			$navegacionDnoveno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),19)->count();
			$navegacionVeinte=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),20)->count();

			$navegacionVuno=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),21)->count();
			$navegacionVdos=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),22)->count();

			$navegacionVtres=DB::table('conexion_liceo')->whereDate('created_at','<=',  $request->fechaFin)->whereDate('created_at','>=',  $request->fechaInicio)->where(DB::raw('hour(created_at)'),23)->count();

			$totalNavegacionHora=$navegacionCero+$navegacionUno+$navegacionDos+$navegacionTres+$navegacionCuatro+$navegacionCinco+$navegacionSeis+$navegacionSiete+$navegacionOcho+$navegacionNueve+$navegacionDiez+$navegacionDuno+$navegacionDdos+$navegacionDtres+$navegacionDcuatro+$navegacionDquinto+$navegacionDsexto+$navegacionDseptimo+$navegacionDoctavo+$navegacionDnoveno+$navegacionVeinte+$navegacionVuno+$navegacionVdos+$navegacionVtres;

			$femenino=DB::table('conexion_liceo')->join('persona_liceo','conexion_liceo.persona_liceo_id','=','persona_liceo.id')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->where('persona_liceo.genero','Femenino')->count();

			$masculino=DB::table('conexion_liceo')->join('persona_liceo','conexion_liceo.persona_liceo_id','=','persona_liceo.id')->whereDate('conexion_liceo.created_at','<=',  $request->fechaFin)->whereDate('conexion_liceo.created_at','>=',  $request->fechaInicio)->where('persona_liceo.genero','Masculino')->count();
			$totalGenero= $masculino+$femenino;

			return response()->json([
				'filtro'=>$request->filtrarDatos,
				'InicioFiltro'=>$request->fechaInicio,
				'finFiltro'=>$request->fechaFin,
				'femenino'=>$femenino,
				'masculino'=>$masculino,
				'totalGenero'=>$totalGenero,
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
				'totalNavegacionHora'=>$totalNavegacionHora,
				'zonaUno'=>$zonaUno,
				'zonaDos'=>$zonaDos,
				'zonaTres'=>$zonaTres,
				'zonaCuatro'=>$zonaCuatro,
				'zonaCinco'=>$zonaCinco,
				'zonaSeis'=>$zonaSeis,
				'totalZona'=>$totalZona,
				'gradoPrimero'=>$gradoPrimero,
				'gradoSegundo'=>$gradoSegundo,
				'gradoTercero'=>$gradoTercero,
				'gradoCuarto'=>$gradoCuarto,
				'gradoQuinto'=>$gradoQuinto,
				'gradoSexto'=>$gradoSexto,
				'gradoSeptimo'=>$gradoSeptimo,
				'gradoOctavo'=>$gradoOctavo,
				'gradoNoveno'=>$gradoNoveno,
				'gradoDecimo'=>$gradoDecimo,
				'gradoOnce'=>$gradoOnce,
				'totalGrado'=>$totalGrado]);

		}

	}
}
