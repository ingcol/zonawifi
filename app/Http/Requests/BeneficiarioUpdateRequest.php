<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeneficiarioUpdateRequest extends FormRequest
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
            'NombreBeneficiario'=>'required|min:3|regex:/^[\pL\s\-]+$/u',
            'ApellidoBeneficiario'=>'required|min:3|regex:/^[\pL\s\-]+$/u',
            'DocumentoBeneficiario' => [
                'required','numeric','min:3','digits_between:4,15','unique:beneficiarios,DocumentoBeneficiario,'.$this->beneficiario
            ],
             /*
            'TelefonoBeneficiario' => [
                'required','numeric','min:3','digits_between:6,15','unique:beneficiarios,TelefonoBeneficiario,'.$this->beneficiario
            ],
            'EdadBeneficiario' => [
                'required','numeric','max:120','min:15'
            ],
            */
            'DireccionBeneficiario'=>'required|min:3',
            'GeneroBeneficiario' => 'required|in:Femenino,Masculino,Otro',

            'barrio_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'NombreBeneficiario.min' => 'El campo nombre  debe tener mínimo tres caracteres',
            'NombreBeneficiario.required' => 'El campo nombre es requerido ',
            'NombreBeneficiario.regex' => 'El formato del campo nombre no es válido',

            'ApellidoBeneficiario.min' => 'El campo apellido  debe tener mínimo tres caracteres',
            'ApellidoBeneficiario.required' => 'El campo apellido es requerido ',
            'ApellidoBeneficiario.regex' => 'El formato del campo apellido no es válido',


            'DocumentoBeneficiario.required' => 'El campo documento es requerido',
            'DocumentoBeneficiario.numeric' => 'El campo documento debe ser numérico',
            'DocumentoBeneficiario.digits_between' => 'El documento no es válido',
            'DocumentoBeneficiario.unique' => 'El número de documento ya se encuentra registrado',
            'DocumentoBeneficiario.min' => 'El número de documento ingresado no es válido',

           /*
            'TelefonoBeneficiario.required' => 'El campo teléfono es requerido',
            'TelefonoBeneficiario.numeric' => 'El campo teléfono debe ser numérico',
            'TelefonoBeneficiario.digits_between' => 'El campo teléfono debe tener de 6 a 15 dígitos',
            'TelefonoBeneficiario.unique' => 'El número de teléfono ya se encuentra registrado',
            'TelefonoBeneficiario.min' => 'El número de teléfono ingresado no es válido',

'EdadBeneficiario.required' => 'El campo edad es requerido',
            'EdadBeneficiario.numeric' => 'El campo edad debe ser numérico',
            'EdadBeneficiario.digits_between' => 'La edad ingresada no es válida',
            'EdadBeneficiario.min' => 'La edad para ser beneficiario debe ser mayor',
            'EdadBeneficiario.max' => 'La edad ingresada no es válida',


            */
            'GeneroBeneficiario.required' => 'El campo género es requerido',
            'GeneroBeneficiario.in' => 'El campo género es requerido',
            'DireccionBeneficiario.required' => 'El campo dirección es requerido',
            'DireccionBeneficiario.min' => 'La dirección ingresada no es válida',
            'barrio_id.required' => 'Debe seleccionar un barrio'



        ];
    }
}
