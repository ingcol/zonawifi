<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empresa;
use App\Http\Requests\EmpresaUpdateRequest;
class EmpresaController extends Controller
{
    public function index(){
      abort_unless(\Gate::allows('Ver datos de la empresa'), 403);
    	return view('empresa.index');
    }
    public function getvue(){
      abort_unless(\Gate::allows('Ver datos de la empresa'), 403);
    	$id=Empresa::first()->id;
    	return Empresa::find($id);
    }
    public function update(EmpresaUpdateRequest $request,$id){
       abort_unless(\Gate::allows('Actualizar datos de la empresa'), 403);
       $Empresa =Empresa::find($id);
       $Empresa->fill($request->all());
       $Empresa->update();
       return $Empresa;
    }
}
