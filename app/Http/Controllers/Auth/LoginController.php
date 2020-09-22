<?php

namespace App\Http\Controllers\Auth;
use App\Turno;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
* Check either username or email.
* @return string
*/

protected function credentials(Request $request)
 {
 $login = $request->input($this->username());

// Comprobar si el input coincide con el formato de E-mail
 $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

return [
 $field => $login,
 'password' => $request->input('password'),
 'EstadoUsuario' => 'Activo'
 ];
 }

public function username()
 {
 return 'login';
 }
 //Sobre escribir método logout
 /*
 public function logout(Request $request)
    {
        $Turno=Turno::find(127);
        $Turno->EstadoTurno="danner";
        $Turno->update();

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
*/
}
