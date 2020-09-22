<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuscarBeneficiarioRequest extends FormRequest
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
            'campoDocumentoBuscar'=>'required|numeric|digits_between:3,15',
        ];
    }
    public function messages()
    {

        return [
            'campoDocumentoBuscar.required' => 'El número de documento es requerido',
            'campoDocumentoBuscar.numeric' => 'El número de documento debe ser numérico',
            'campoDocumentoBuscar.digits_between' => 'El número de documento no es válido',

        ];

    }
}
