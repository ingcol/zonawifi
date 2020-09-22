<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class AyudaUpdateRequest extends FormRequest
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
        $today = Carbon::now()->addDay();
      $endDate=$today->format('Y-m-d');
        return [
            'FechaAyuda'=>'date_format:"Y-m-d"|required|before:'.$endDate,
            'DescripcionAyuda'=> 'required|min:5'
        ];
    }

    public function messages(){
        return [
        'FechaAyuda.before' => 'La fecha no debe ser mayor a la actual ',
        'FechaAyuda.required'=> 'El campo fecha es requerido',
        'FechaAyuda.date_format' => 'El formato requerido para la fecha es: año-mes-día',
        'beneficiario_id.required'=> 'Debe seleccionar un beneficiario',
        'DescripcionAyuda.required'=> 'El campo descripción es requerido',
        'DescripcionAyuda.min'=> 'La descripción ingresada no es válida',


        ];
    }
}
