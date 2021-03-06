<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
        $fecha_actual = new \DateTime();
        return [
            'monto'         =>  'required|numeric|min:1',
            'fecha'         =>  'required|before_or_equal:'.$fecha_actual->format('Y-m-d'),
            'medio_pago'    =>  'required|in:1,2,3,4',
        ];
    }
}
