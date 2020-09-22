<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ayuda;
use App\Beneficiario;
use App\Http\Requests\AyudaStoreRequest;
use App\Http\Requests\AyudaUpdateRequest;
use Illuminate\Support\Facades\Auth;
class AyudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(AyudaStoreRequest $request)
    {
        abort_unless(\Gate::allows('Registrar ayudas'), 403);
        /*Validar si el beneficiario ya tiene ayudas
        $countAyuda=Ayuda::where('beneficiario_id',$request->beneficiario_id)->count();
        if ($countAyuda>0) {
            return response()->json(['errors' => ['message' => ['Este beneficiario ya tiene una ayuda entregada']]], 422);
        }

        */
        $ayuda= new Ayuda;
        $ayuda->beneficiario_id=$request->beneficiario_id;
        $ayuda->FechaAyuda=$request->FechaAyuda;
        $ayuda->DescripcionAyuda=$request->DescripcionAyuda;
        $ayuda->user_id=Auth::user()->id;
        $ayuda->save();

       //Contar y actualizar cantidad de ayudas
        $cantidadAyudaBeneficiario=Ayuda::where('beneficiario_id',$request->beneficiario_id)->count();

        Beneficiario::where('id', $request->beneficiario_id)->update(['CantidadAyuda' =>  $cantidadAyudaBeneficiario ]);

        return $ayuda;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(\Gate::allows('Ver ayudas'), 403);
        return Ayuda::with('usuario')->where('beneficiario_id',$id)->orderBy('id','desc')->get();
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
    public function update(AyudaUpdateRequest $request, $id)
    {
        abort_unless(\Gate::allows('Actualizar ayudas'), 403);
        $ayuda=Ayuda::find($id);
        $ayuda->fill($request->all());
        $ayuda->update();
        return $ayuda;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(\Gate::allows('Eliminar ayudas'), 403);
        $ActualizarCantAyuda=Ayuda::find($id);

        $ayuda=Ayuda::where('id',$id)->delete();

        //Contar y actualizar cantidad de ayudas

        $cantidadAyudaBeneficiario=Ayuda::where('beneficiario_id',$ActualizarCantAyuda->beneficiario_id)->count();

        Beneficiario::where('id', $ActualizarCantAyuda->beneficiario_id)->update(['CantidadAyuda' =>  $cantidadAyudaBeneficiario ]);
        return $ayuda;
    }
}
