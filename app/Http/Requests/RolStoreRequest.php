<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolStoreRequest extends FormRequest
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
            'title' => 'required|min:3|unique:roles,title',
                    ];
    }
    public function messages()
    {
        return [
            'title.required' => 'El campo nombre es requerido ',
            'title.min' => 'El campo nombre debe tener al menos tres caracteres',
            'title.unique' => 'El nombre del campo rol ya se encuentra registrado',
        ];
    }
}
