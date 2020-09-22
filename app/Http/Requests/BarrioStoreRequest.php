<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarrioStoreRequest extends FormRequest
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

            'NombreBarrio' => 'required|min:3|unique:barrios,NombreBarrio',
            'EstadoBarrio' => 'required|in:Activo,Inactivo',

        ];

    }
    public function messages()
{
    return [
        'NombreBarrio.required' => 'El campo nombre no debe estar vacío',
        'NombreBarrio.unique' => 'El nombre ya esta registrado, utilice otro',
        'NombreBarrio.min' => 'El Nombre debe tener al menos 3 caracteres',
        'EstadoBarrio.required' => 'El campo estado no debe estar vacío',
        'EstadoBarrio.in' => 'El campo estado no debe estar vacío',
    ];
}
}
