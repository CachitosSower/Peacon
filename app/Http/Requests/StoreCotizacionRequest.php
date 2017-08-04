<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest
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
            'nombre'            =>  'required',
            'correo'            =>  'required|email',
            'telefono'          =>  'nullable|numeric|digits:9',
            'fecha_emision'     =>  'required',
            'fecha_vencimiento' =>  'required',
        ];
    }
}
