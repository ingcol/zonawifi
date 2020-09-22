<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Barrio;
use App\Http\Requests\BarrioStoreRequest;
use App\Http\Requests\BarrioUpdateRequest;
use App\Imports\ImportBarrio;
use Maatwebsite\Excel\Facades\Excel;
class BarrioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function barrioImportar(Request $request){
//dd(request()->file('file'));
         Excel::import(new ImportBarrio,request()->file('file'));

         


    }
    public function index()
    {
        abort_unless(\Gate::allows('Ver barrios'), 403);
        return view('barrio.index');

    }

    public function datos(Request $request){

       if ($request->input('showdata')) {
        return Barrio::orderBy('id', 'desc')->get();

    }
    $columns = ['NombreBarrio', 'DescripcionBarrio', 'EstadoBarrio'];
    $length = $request->input('length');
    $column = $request->input('column');
    $search_input = $request->input('search');

    $query = Barrio::select('NombreBarrio', 'DescripcionBarrio', 'EstadoBarrio')->orderBy($columns[$column]);

    if ($search_input) {
        $query->where(function($query) use ($search_input) {
            $query->where('NombreBarrio', 'like', '%' . $search_input . '%')
            ->orWhere('DescripcionBarrio', 'like', '%' . $search_input . '%')
            ->orWhere('EstadoBarrio', 'like', '%' . $search_input . '%');
        });
    }

    $barrios = $query->paginate($length);
    return ['data' => $barrios];
}
public function listabarrio(){
    return Barrio::where('EstadoBarrio','Activo')->get();
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarrioStoreRequest $request)
    {
        abort_unless(\Gate::allows('Registrar barrios'), 403);
        $Barrio =Barrio::create($request->all());
        return response()->json($Barrio);
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
    public function update(BarrioUpdateRequest $request, $id)
    {
        abort_unless(\Gate::allows('Actualizar barrios'), 403);
        $Barrio=Barrio::find($id);
        $Barrio->fill($request->all());
        $Barrio->update();
        return $Barrio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
