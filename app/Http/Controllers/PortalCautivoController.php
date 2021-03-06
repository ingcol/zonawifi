<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PortalCautivoController extends Controller
{
    public function portalCautivoRegistrar(Request $request){
    
    //dd($request->all());
    
    $rules = [
         'nombrePersona' => [
            'required','min:3',
           
        ],
        'edadPersona'=>'required|numeric|min:5|max:105',
        'generoPersona'=>'required',
        'barrioPersona'=>'required',
        'ocupacionPersona'=>'required',
        'poblacionPersona'=>'required',
        //'nacionalidadPersona'=>'required'
        
        


    ]; 

    $messages = [
       'nombrePersona.required' => 'El campo nombre no debe estar vacío',
       'nombrePersona.min' => 'El nombre no es válido',
       'edadPersona.min' => 'La edad ingresada no es válida',
       'edadPersona.required' => 'El campo edad es requerido',
       'edadPersona.max' => 'La edad ingresada no es válida',
       'edadPersona.numeric' => 'La edad ingresada no es válida',
       'generoPersona.required' => 'Debe seleccionar un género',
       'barrioPersona.required' => 'Debe seleccionar un barrio',
       //'nacionalidadPersona.required' => 'Debe seleccionar nacionalidad',
       




   ];

   $this->validate($request, $rules, $messages);
    $persona=new Persona;
    $persona->NombrePersona=$request->nombrePersona;
    $persona->EdadPersona=$request->edadPersona;
    $persona->GeneroPersona=$request->generoPersona;
    $persona->BarrioPersona=$request->barrioPersona;
    $persona->OcupacionPersona=$request->ocupacionPersona;
    $persona->PoblacionPersona=$request->poblacionPersona;
    $persona->MacPersona=$request->macPersona;
    $persona->NacionalidadPersona=$request->nacionalidadPersona;

    $persona->save();
    return $persona;




}
}
