<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departamento;

class DepartamentoController extends Controller
{
    public function index(){
    	return Departamento::where('EstadoDepartamento','Activo')->get();




    }
}
