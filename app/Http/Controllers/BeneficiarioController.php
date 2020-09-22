<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiario;
use App\Http\Requests\BuscarBeneficiarioRequest;
use App\Http\Requests\BeneficiarioStoreRequest;
use App\Http\Requests\BeneficiarioUpdateRequest;
use Illuminate\Support\Facades\Auth;
class BeneficiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('Ver beneficiarios'), 403);
        return view('beneficiario.index');
    }
    public function beneficiario(BuscarBeneficiarioRequest $request){
     abort_unless(\Gate::allows('Ver beneficiarios'), 403);
     $beneficiario=Beneficiario::where('DocumentoBeneficiario',$request->campoDocumentoBuscar)->with('barrio')->get();
     $countBeneficiario=$beneficiario->count();

     if ($countBeneficiario) {
        foreach ($beneficiario as  $value) {
        }
        $datosBeneficiario=Beneficiario::find($value->id);
        $barrioBeneficiario=$datosBeneficiario->barrio->NombreBarrio;
        $usuarioBeneficiario=$datosBeneficiario->usuario->NombreUsuario.' '.$datosBeneficiario->usuario->ApellidoUsuario;
        $cantidadAyudas=$datosBeneficiario->ayudas->count();

        return response()->json(['datosBeneficiario'=> $datosBeneficiario,'barrioBeneficiario'=>$barrioBeneficiario,'usuarioBeneficiario'=>$usuarioBeneficiario,'cantidadAyudas'=>$cantidadAyudas]);

    }
    else{
        return response()->json(['errors' => ['message' => ['Este número de documento no se encuentra registrado']]], 422);
    }




}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiarioStoreRequest $request)
    {
       abort_unless(\Gate::allows('Registrar beneficiarios'), 403);
       //Validad edad y teléfono
        if (!empty($request->TelefonoBeneficiario)) {
            if (!is_numeric($request->TelefonoBeneficiario)) {
                return response()->json(['errors' => ['message' => ['El número de teléfono debe ser numérico']]], 422);
            }
            if (strlen($request->TelefonoBeneficiario)<=5){

                return response()->json(['errors' => ['message' => ['El número de teléfono  no es válido']]], 422);
            }

        }
        //Validad edad
        if (!empty($request->EdadBeneficiario)) {
            if (!is_numeric($request->EdadBeneficiario)) {
                return response()->json(['errors' => ['message' => ['El campo edad debe ser numérico']]], 422);
            }
            if ($request->EdadBeneficiario<=10){

                return response()->json(['errors' => ['message' => ['La edad ingresada  no es válida']]], 422);
            }

        }
       $beneficiario=new Beneficiario;
       $beneficiario->NombreBeneficiario=$request->NombreBeneficiario;
       $beneficiario->ApellidoBeneficiario=$request->ApellidoBeneficiario;
       $beneficiario->DocumentoBeneficiario=$request->DocumentoBeneficiario;
       $beneficiario->TelefonoBeneficiario=$request->TelefonoBeneficiario;
       $beneficiario->DireccionBeneficiario=$request->DireccionBeneficiario;
       $beneficiario->GeneroBeneficiario=$request->GeneroBeneficiario;
       $beneficiario->EdadBeneficiario=$request->EdadBeneficiario;
       $beneficiario->barrio_id=$request->barrio_id;
       $beneficiario->user_id=Auth::user()->id;
       $beneficiario->save();
       return $beneficiario;
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiarioUpdateRequest $request, $id)
    {
        abort_unless(\Gate::allows('Actualizar beneficiarios'), 403);
        //Validad edad y teléfono
        if (!empty($request->TelefonoBeneficiario)) {
            if (!is_numeric($request->TelefonoBeneficiario)) {
                return response()->json(['errors' => ['message' => ['El número de teléfono debe ser numérico']]], 422);
            }
            if (strlen($request->TelefonoBeneficiario)<=5){

                return response()->json(['errors' => ['message' => ['El número de teléfono  no es válido']]], 422);
            }

        }
        //Validad edad
        if (!empty($request->EdadBeneficiario)) {
            if (!is_numeric($request->EdadBeneficiario)) {
                return response()->json(['errors' => ['message' => ['El campo edad debe ser numérico']]], 422);
            }
            if ($request->EdadBeneficiario<=10){

                return response()->json(['errors' => ['message' => ['La edad ingresada  no es válida']]], 422);
            }

        }

        $beneficiario=Beneficiario::find($id);
        $beneficiario->fill($request->all());
        $beneficiario->update();
        return $beneficiario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        abort_unless(\Gate::allows('Eliminar beneficiarios'), 403);
        $beneficiario=Beneficiario::where('id',$id)->delete();
        return $beneficiario;
    }
}
