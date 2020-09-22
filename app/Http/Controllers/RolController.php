<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Http\Requests\RolStoreRequest;
use App\Http\Requests\RolUpdateRequest;
use DB;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('Ver roles'), 403);return view('rol.index');

    }
    public function getvue(Request $request){
        abort_unless(\Gate::allows('Ver roles'), 403);
        if ($request->input('showdata')) {
            return Role::with('permissions')->orderBy('id', 'desc')->get();

        }
        $columns = ['title'];
        $length = $request->input('length');
        $column = $request->input('column');
        $search_input = $request->input('search');

        $query = Role::select('title')->orderBy($columns[$column]);

        if ($search_input) {
            $query->where(function($query) use ($search_input) {
                $query->where('title', 'like', '%' . $search_input . '%');
            });
        }

        $roles = $query->paginate($length);
        return ['data' => $roles];


    }

    public function rolcheckbox(){
        $Permission=Permission::get();
        return $Permission;
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
    public function store(RolStoreRequest $request)
    {
        abort_unless(\Gate::allows('Registrar roles'), 403);
        if (!empty($request->permissions)) {

            $Permission=$request->permissions;

            foreach ($Permission as $value) {

                $Validar=Permission::find($value);
                if (is_null($Validar)) {
                    return response()->json(['errors' => ['message' => ['Acción no válida']]], 422);
                }

            }
            //Insert
            $Role = new Role;
            $Role->title = $request->title;

            $Role->save();
            $Role->permissions()->sync($request->input('permissions', []));
            return response()->json($Role);
        }
        else{
            return response()->json(['errors' => ['message' => ['Debe selecionar permisos para el rol']]], 422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permisocheck($id){
        $Role=Role::find($id);
        $Permission=$Role->permissions;


    //$DB=$Role->permissions;
    //$DB=Role::get();

        return $Permission;


    }
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
    public function update(RolUpdateRequest $request, $id)
    {
       abort_unless(\Gate::allows('Actualizar roles'), 403);
        $Role = Role::find($id);
        if (!empty($request->permissions)) {

            $Permission=$request->permissions;

            foreach ($Permission as $value) {

                $Validar=Permission::find($value);
                if (is_null($Validar)) {
                    return response()->json(['errors' => ['message' => ['Acción no válida']]], 422);
                }

            }
            //Update
            $Role->update($request->all());
            $Role->permissions()->sync(array_filter((array)$request->input('permissions')));
            return response()->json($Role);
        }
        else{
            return response()->json(['errors' => ['message' => ['Debe selecionar permisos para el rol']]], 422);
        }
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
