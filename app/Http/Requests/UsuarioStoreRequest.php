<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

                    'NombreUsuario'=>'required|min:3|regex:/^[\pL\s\-]+$/u',
                    'ApellidoUsuario'=>'required|min:3|regex:/^[\pL\s\-]+$/u',
                    'DocumentoUsuario' => [
                        'required','numeric','digits_between:6,15','unique:users,DocumentoUsuario'
                    ],
                    'email' => [
                        'required','string',
                        'unique:users,email'
                    ],
                    'username' => [
                        'required','min:6','string',
                        'unique:users,username'
                    ],

                    'TelefonoUsuario' => [
                        'required','numeric','digits_between:6,15','unique:users,TelefonoUsuario'
                    ],
                    'EstadoUsuario' => 'required|in:Activo,Inactivo',
                    'password' => 'required|string|min:6|confirmed',
                    'RolUsuario' => 'required|numeric|min:1',
                    'GeneroUsuario' => 'required|in:Femenino,Masculino,Otro',

        ];
    }
    public function messages()
{
    return [
        'NombreUsuario.min' => 'El campo nombre  debe tener mínimo tres caracteres',
        'NombreUsuario.required' => 'El campo nombre es requerido ',
        'ApellidoUsuario.min' => 'El campo apellido  debe tener mínimo tres caracteres',
        'ApellidoUsuario.required' => 'El campo apellido es requerido ',

        'email.required' => 'El campo email es requerido',
        'email.unique' => 'Este email ya se encuentra registrado. Use otro',
        'username.unique' => 'El nombre de usuario ya se encuentra registrado. Use otro',
        'username.required' => 'El campo usuario es requerido',
        'username.min' => 'El campo usuario debe tener mínimo 6 caracteres',
        'EstadoUsuario.required' => 'El campo estado es requerido',
        'EstadoUsuario.in' => 'El campo estado es requerido',

        'TelefonoUsuario.required' => 'El campo teléfono es requerido',
        'TelefonoUsuario.numeric' => 'El campo teléfono debe ser numérico',
        'TelefonoUsuario.digits_between' => 'El campo teléfono debe tener de 6 a 15 dígitos',
        'TelefonoUsuario.unique' => 'El número de teléfono ya se encuentra registrado',

        'DocumentoUsuario.required' => 'El campo documento es requerido',
        'DocumentoUsuario.numeric' => 'El campo documento debe ser numérico',
        'DocumentoUsuario.digits_between' => 'El campo documento debe tener de 6 a 15 dígitos',
        'DocumentoUsuario.unique' => 'El número de documento ya se encuentra registrado',

         'password.min' => 'El campo contraseña debe tener mínimo 6 caracteres',
         'password.required' => 'El campo contraseña es requerido',
         'password.confirmed' => 'Debe confirmar la contraseña',
         'RolUsuario.required' => 'Debe seleccionar un rol',
         'RolUsuario.min' => 'Debe seleccionar un rol',
         'RolUsuario.numeric' => 'Debe seleccionar un rol',
         'GeneroUsuario.required' => 'El campo género es requerido',
        'GeneroUsuario.in' => 'El campo género es requerido',


    ];
}
}
