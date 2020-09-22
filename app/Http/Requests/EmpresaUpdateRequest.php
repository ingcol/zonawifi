<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaUpdateRequest extends FormRequest
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
            'NombreEmpresa'=>'required|min:2|',
            'TelefonoEmpresa'=>'required|numeric|digits_between:6,15',
            'DireccionEmpresa'=>'required|min:3|',
            'EmailEmpresa' => [
                        'required','string','email'
                    ],

        ];
    }
    public function messages()
    {
        return [

            'NombreEmpresa.min' => 'El campo nombre  debe tener mínimo dos caracteres',
            'NombreEmpresa.required' => 'El campo nombre es requerido ',
            'TelefonoEmpresa.numeric' => 'El campo teléfono debe ser numérico ',
            'TelefonoEmpresa.required' => 'El campo teléfono es requerido',
            'TelefonoEmpresa.digits_between' => 'El campo teléfono debe tener de 6 a 15 dígitos',
            'DireccionEmpresa.required' => 'El campo dirección es requerido',

            'EmailEmpresa.required' => 'El campo email es requerido',
            'EmailEmpresa.email'=>'El formato de email no es válido'
        ];
    }
}
