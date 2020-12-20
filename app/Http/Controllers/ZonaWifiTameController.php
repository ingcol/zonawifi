<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ZonaWifiTame;


class ZonaWifiTameController extends Controller
{
    public function portalZonaTameRegistrar(Request $request){
    
    //dd($request->all());
    
    $rules = [
         'nombrePersona' => [
            'required','min:3',
           
        ],
        'edadPersona'=>'required|numeric|min:5|max:102',
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
       //'nacionalidadPersona.required' => 'Debe seleccionar una nacionalidad',

  ];


  /*

   $this->validate($request, $rules, $messages);
    $datoPersona=new ZonaWifiTame;
    $datoPersona->NombrePersona=$request->nombrePersona;
    $datoPersona->EdadPersona=$request->edadPersona;
    $datoPersona->GeneroPersona=$request->generoPersona;
    $datoPersona->BarrioPersona=$request->barrioPersona;
    $datoPersona->OcupacionPersona=$request->ocupacionPersona;
    $datoPersona->PoblacionPersona=$request->poblacionPersona;
    $datoPersona->MacPersona=$request->macPersona;
    $datoPersona->NacionalidadPersona=$request->nacionalidadPersona;


    $datoPersona->save();
    return $datoPersona;
    */




}
}
