<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Beneficiario;
use App\Ayuda;
use App\Barrio;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SinAyudaExport;
class BeneficiarioSinAyudaController extends Controller
{
	public function index(){
		abort_unless(\Gate::allows('Ver beneficiario sin ayuda'), 403);
		return view('informe.beneficiario_sin_ayuda.index');}
		public function excel(Request $request){
		abort_unless(\Gate::allows('Exportar beneficiario sin ayuda'), 403);
		return Excel::download(new SinAyudaExport($request->barrio_id,$request->generoBeneficiario),'beneficiario_sin_ayuda.xlsx');
	}
		public function sinAyuda(Request $request){
			abort_unless(\Gate::allows('Ver beneficiario sin ayuda'), 403);

    	//Todos los campos en la primera posición
			if ($request->barrio_id=="-1" && $request->generoBeneficiario=="-1") {
				if ($request->input('showdata')) {
					$beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->select('beneficiarios.*','barrios.NombreBarrio')->get();
					$cantidadFemenino=0;
					$cantidadMasculino=0;
					$cantidadGeneroOtro=0;
					$cantidadBeneficiario=0;

					$beneficiarios = collect();
					foreach ($beneficiario as  $value) {
						$countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
						if ($countAyudaBeneficiario==0) {

							$subQuery=$beneficiario->where('id',$value->id);
							$beneficiarios = $beneficiarios->concat($subQuery);
							if ($value->GeneroBeneficiario=="Femenino") {
								$cantidadFemenino++;
							}
							elseif ($value->GeneroBeneficiario=="Masculino") {
								$cantidadMasculino++;
							}
							else{
								$cantidadGeneroOtro++;
							}
							$cantidadBeneficiario++;
						}

					}
					return response()->json(['beneficiario'=>$beneficiarios,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);

				}

			}
			//Barrio lleno y género en todos
			if ($request->barrio_id!="-1" && $request->generoBeneficiario=="-1") {
				if ($request->input('showdata')) {
					$beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',$request->barrio_id)->select('beneficiarios.*','barrios.NombreBarrio')->get();
					$cantidadFemenino=0;
					$cantidadMasculino=0;
					$cantidadGeneroOtro=0;
					$cantidadBeneficiario=0;

					$beneficiarios = collect();
					foreach ($beneficiario as  $value) {
						$countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
						if ($countAyudaBeneficiario==0) {

							$subQuery=$beneficiario->where('id',$value->id);
							$beneficiarios = $beneficiarios->concat($subQuery);
							if ($value->GeneroBeneficiario=="Femenino") {
								$cantidadFemenino++;
							}
							elseif ($value->GeneroBeneficiario=="Masculino") {
								$cantidadMasculino++;
							}
							else{
								$cantidadGeneroOtro++;
							}
							$cantidadBeneficiario++;
						}

					}
					return response()->json(['beneficiario'=>$beneficiarios,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);

				}

			}

			//Género lleno y barrio en todos
			if ($request->barrio_id=="-1" && $request->generoBeneficiario!="-1") {
				if ($request->input('showdata')) {
					$beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->select('beneficiarios.*','barrios.NombreBarrio')->get();
					$cantidadFemenino=0;
					$cantidadMasculino=0;
					$cantidadGeneroOtro=0;
					$cantidadBeneficiario=0;

					$beneficiarios = collect();
					foreach ($beneficiario as  $value) {
						$countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
						if ($countAyudaBeneficiario==0) {

							$subQuery=$beneficiario->where('id',$value->id);
							$beneficiarios = $beneficiarios->concat($subQuery);
							if ($value->GeneroBeneficiario=="Femenino") {
								$cantidadFemenino++;
							}
							elseif ($value->GeneroBeneficiario=="Masculino") {
								$cantidadMasculino++;
							}
							else{
								$cantidadGeneroOtro++;
							}
							$cantidadBeneficiario++;
						}

					}
					return response()->json(['beneficiario'=>$beneficiarios,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);

				}

			}
			//Barrio lleno y género llenos
			if ($request->barrio_id!="-1" && $request->generoBeneficiario!="-1") {
				if ($request->input('showdata')) {
					$beneficiario=Beneficiario::orderBy('id', 'desc')->join('barrios', 'beneficiarios.barrio_id', '=', 'barrios.id')->where('barrios.id',$request->barrio_id)->where('beneficiarios.GeneroBeneficiario',$request->generoBeneficiario)->select('beneficiarios.*','barrios.NombreBarrio')->get();
					$cantidadFemenino=0;
					$cantidadMasculino=0;
					$cantidadGeneroOtro=0;
					$cantidadBeneficiario=0;

					$beneficiarios = collect();
					foreach ($beneficiario as  $value) {
						$countAyudaBeneficiario=Ayuda::where('beneficiario_id',$value->id)->count();
						if ($countAyudaBeneficiario==0) {

							$subQuery=$beneficiario->where('id',$value->id);
							$beneficiarios = $beneficiarios->concat($subQuery);
							if ($value->GeneroBeneficiario=="Femenino") {
								$cantidadFemenino++;
							}
							elseif ($value->GeneroBeneficiario=="Masculino") {
								$cantidadMasculino++;
							}
							else{
								$cantidadGeneroOtro++;
							}
							$cantidadBeneficiario++;
						}

					}
					return response()->json(['beneficiario'=>$beneficiarios,'cantidadFemenino'=>$cantidadFemenino,'cantidadMasculino'=>$cantidadMasculino,'cantidadGeneroOtro'=>$cantidadGeneroOtro,'cantidadBeneficiario'=>$cantidadBeneficiario ]);

				}

			}
		}//Método
	}

