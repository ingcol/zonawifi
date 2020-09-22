<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Requests\UsuarioStoreRequest;

class UsuarioController extends Controller
{
   use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function index()
    {
        abort_unless(\Gate::allows('Ver usuarios'), 403);

        return view('usuario.index');


    }
    public function cuenta(){

        return view('cuenta.index');
    }
    public function cuentavue(){
        $UserLog=auth()->id();
        $User=User::find($UserLog);
        return $User;
    }
    public function datos(Request $request){
       abort_unless(\Gate::allows('Ver usuarios'), 403);


       if ($request->input('showdata')) {
        return User::with('roles')->orderBy('id', 'desc')->get();

    }
    $columns = ['NombreUsuario', 'ApellidoUsuario', 'DocumentoUsuario','email','username','EstadoUsuario','TelefonoUsuario','GeneroUsuario'];
    $length = $request->input('length');
    $column = $request->input('column');
    $search_input = $request->input('search');

    $query = User::select('NombreUsuario', 'ApellidoUsuario', 'DocumentoUsuario','email','username','EstadoUsuario','TelefonoUsuario','GeneroUsuario')->orderBy($columns[$column]);

    if ($search_input) {
        $query->where(function($query) use ($search_input) {
            $query->where('NombreUsuario', 'like', '%' . $search_input . '%')
            ->orWhere('ApellidoUsuario', 'like', '%' . $search_input . '%')
            ->orWhere('DocumentoUsuario', 'like', '%' . $search_input . '%')->orWhere('email', 'like', '%' . $search_input . '%')->orWhere('username', 'like', '%' . $search_input . '%')->orWhere('EstadoUsuario', 'like', '%' . $search_input . '%')->orWhere('TelefonoUsuario', 'like', '%' . $search_input . '%')->orWhere('GeneroUsuario', 'like', '%' . $search_input . '%');
        });
    }

    $usuarios = $query->paginate($length);
    return ['data' => $usuarios];


}
public function selectrol(){
    $Role=Role::get();
    return $Role;
        //return response()->json($User);
}
public function selectusuario(){
    $User=User::with('turnos')->get();
    return $User;
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
    public function store(UsuarioStoreRequest $request)
    {
      abort_unless(\Gate::allows('Registrar usuarios'), 403);
      $User = new User;
      $User->NombreUsuario = $request->NombreUsuario;
      $User->ApellidoUsuario=$request->ApellidoUsuario;
      $User->DocumentoUsuario=$request->DocumentoUsuario;
      $User->email=$request->email;
      $User->GeneroUsuario=$request->GeneroUsuario;
      $User->username=$cadena=str_replace(' ', '', $request->username);
      $User->EstadoUsuario=$request->EstadoUsuario;
      $User->TelefonoUsuario=$request->TelefonoUsuario;

      $User->password=Hash::make($request['password']);

      $Role=Role::find($request->RolUsuario);
      if (is_null($Role)) {
        return response()->json(['errors' => ['message' => ['Acción no valida']]], 422);
    }
    $User->save();
    $User->roles()->sync($request->input('RolUsuario'));
    return response()->json($User);
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
    public function update(UsuarioUpdateRequest $request, $id)
    {

       if (isset($request->EstadoUsuario)) {
        $User = User::findOrFail($id);
        $User->NombreUsuario=$request->NombreUsuario;
        $User->ApellidoUsuario=$request->ApellidoUsuario;
        $User->DocumentoUsuario=$request->DocumentoUsuario;
        $User->email=$request->email;
        $User->GeneroUsuario=$request->GeneroUsuario;
        $User->username=$cadena=str_replace(' ', '', $request->username);
        $User->EstadoUsuario=$request->EstadoUsuario;
        $User->TelefonoUsuario=$request->TelefonoUsuario;

        if (empty($request->password) && empty($request->RolUsuario)) {
            $User->update();

        }
        if(!empty($request->password) && !empty($request->RolUsuario)) {
            $Role=Role::find($request->RolUsuario);
            if (is_null($Role)) {
                return response()->json(['errors' => ['message' => ['Acción no valida']]], 422);
            }
            else{

                $User->password=Hash::make($request['password']);

                $User->update();
                $User->roles()->sync($request->input('RolUsuario'));

            }

        }

        if(!empty($request->password) && empty($request->RolUsuario)) {
            $User->password=Hash::make($request['password']);

            $User->update();
        }
        if(empty($request->password) && !empty($request->RolUsuario)) {
            $Role=Role::find($request->RolUsuario);
            if (is_null($Role)) {
                return response()->json(['errors' => ['message' => ['Acción no valida']]], 422);
            }
            else{

                $User->update();
                $User->roles()->sync($request->input('RolUsuario'));

            }
        }
    }
    else{
            //abort_unless(\Gate::allows('user_access'), 403);

        $UserLog=auth()->id();

        //polices
        $User=User::find($UserLog);
        $this->authorize('policyuser',$User);

        $User->NombreUsuario=$request->NombreUsuario;
        $User->ApellidoUsuario=$request->ApellidoUsuario;
        $User->DocumentoUsuario=$request->DocumentoUsuario;
        $User->email=$request->email;
        $User->GeneroUsuario=$request->GeneroUsuario;
        $User->username=$cadena=str_replace(' ', '', $request->username);


        $User->TelefonoUsuario=$request->TelefonoUsuario;
        if (empty($request->password)) {
            $User->update();

        }
        else{
            $User->password=Hash::make($request['password']);

            $User->update();


        }

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
