<?php

namespace App\Http\Controllers;
use App\Beneficiario;
use App\Ayuda;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AyudasExport;
use App\Barrio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class informeExcelController extends Controller
{


	public function index(){
		abort_unless(\Gate::allows('Ver infome múltiple'), 403);
		return view('informe.informe_excel.index');
	}
	public function excel(Request $request){
		abort_unless(\Gate::allows('Exportar infome múltiple'), 403);
		return Excel::download(new AyudasExport($request->fechaInicio,$request->fechaFin,$request->edadInicial,$request->edadFinal,$request->barrio_id,$request->generoBeneficiario),'beneficiarios.xlsx');
}
public function informeexcel(Request $request)
{
	$FechaActual= Carbon::now();
    // Validar fechas
	if ($request->fechaInicio>$FechaActual->format('Y-m-d')) {
		return response()->json(['errors' => ['message' => ['La fecha inicial no debe ser mayor a la fecha actual']]], 422);
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
//Validar edad
	if (!empty($request->edadInicial) &&  empty($request->edadFinal)) {
		return response()->json(['errors' => ['message' => ['Debe ingresar una edad final']]], 422);
	}
	if (empty($request->edadInicial) &&  !empty($request->edadFinal)) {
		return response()->json(['errors' => ['message' => ['Debe ingresar una edad inicial']]], 422);
	}
	if ($request->edadInicial>$request->edadFinal) {
		return response()->json(['errors' => ['message' => ['La edad inicial no debe ser mayor a la edad final']]], 422);
	}

	if (!empty($request->edadInicial)  && !is_numeric($request->edadInicial)) {
		return response()->json(['errors' => ['message' => ['El campo edad inicial debe ser numérico']]], 422);
	}
	if (!empty($request->edadFinal)  && !is_numeric($request->edadFinal)) {
		return response()->json(['errors' => ['message' => ['El campo edad final debe ser numérico']]], 422);
	}


//Filtro todos los campos vacíos o en primera posición

	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario=="-1") {
		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
			$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
			$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

			$cantidadBeneficiario=$ayuda->count();

		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;



	}
//Filtro con fechas llenas; los demas campos vacíos y en la primera posición
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;


	}
//Filtro con fechas llenas; y campos edad llenos, los demás vacíos o  en la primera posición
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;



	}
//Filtro con fechas llenas; y campos edad llenos,barrio lleno también  en la primera posición, género en la primera prosición
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->where('barrios.id',$request->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;



	}
//Todos los campos llenos
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->where('barrios.id',$request->barrio_id)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;



	}
//Fechas vacías, edades llenas, barrio todos,Género todos
	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;

	}
//fechas vacías,edades vacías, barrio lleno,género en todos
	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',  $request->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;

	}
//Género lleno, los démas vacíos
	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.GeneroBeneficiario',  $request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;



	}

//Fechas llenas y género lleno. Los démas campos vacíos
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;
	}

//Fechas llenas, edades llenas, barrio en todos, género llenos
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;

	}
//Género lleno, barrio lleno; los demás vacíos

	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',$request->barrio_id)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;

	}
//Edad lleno, barrio lleno, género  lleno, fechas vacías
	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->where('barrios.id',$request->barrio_id)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;
	}

//Fechas vacias, género en todos, barrio lleno, edad lleno
	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->where('barrios.id',$request->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;
	}

//Fechas llenas, edades vacías, barrios llenos, género todos

	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario=="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('barrios.id',$request->barrio_id)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;



	}
//Fechas llenas, barrios llenos, género lleno, edades vacías
	if (!empty($request->fechaInicio)  &&  !empty($request->fechaFin) && empty($request->edadInicial)  &&  empty($request->edadFinal) && $request->barrio_id!="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->whereDate('ayudas.FechaAyuda','<=',  $request->fechaFin)->whereDate('ayudas.FechaAyuda','>=',  $request->fechaInicio)->where('barrios.id',$request->barrio_id)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();

		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
		$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
		$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

		$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;
	}
//Fechas vacías,edad llenas, barrios en todos, género lleno
	if (empty($request->fechaInicio)  &&  empty($request->fechaFin) && !empty($request->edadInicial)  &&  !empty($request->edadFinal) && $request->barrio_id=="-1" && $request->generoBeneficiario!="-1") {

		$ayuda= Ayuda::groupBy('beneficiario_id')->orderBy('ayudas.id','desc')->join('beneficiarios', 'ayudas.beneficiario_id', '=', 'beneficiarios.id')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.EdadBeneficiario','<=',  $request->edadFinal)->where('beneficiarios.EdadBeneficiario','>=',  $request->edadInicial)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->selectRaw('beneficiarios.DocumentoBeneficiario,beneficiarios.NombreBeneficiario,beneficiarios.ApellidoBeneficiario,beneficiarios.EdadBeneficiario,beneficiarios.DireccionBeneficiario,barrios.NombreBarrio,beneficiarios.TelefonoBeneficiario,beneficiarios.GeneroBeneficiario,beneficiarios.CantidadAyuda')->get();
		$cantidadMasculino=$ayuda->where('GeneroBeneficiario','Masculino')->count();
			$cantidadFemenino=$ayuda->where('GeneroBeneficiario','Femenino')->count();
			$cantidadGeneroOtro=$ayuda->where('GeneroBeneficiario','Otro')->count();

			$cantidadBeneficiario=$ayuda->count();
		return response()->json(['ayuda'=>$ayuda,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);;

	}



}//Método


}//Clase
