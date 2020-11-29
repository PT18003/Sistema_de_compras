<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoCreate extends FormRequest
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
            'nombres'=>'required',
            'apellidos'=>'required',
            'genero'=>'exists:genero,id',//en el exists es que tiene que ser el value de la tabla genero y campo id
            'estadocivil'=>'exists:estadocivil,id',
            'departamento'=>'exists:departamento,id',
            'municipio'=>'exists:municipio,id',
            'direccion'=>'required',
            'telefono'=>'required|digits:8',
            'dui'=>'required|digits:9',
            'salario'=>'required|numeric|between:0,9999.99|regex:/^\d{1,3}(?:\d\d\d)*(?:.\d{1,2})?$/',
            'vencimientoContrato'=>'required|date|after:yesterday',
            'areatrabajo'=>'exists:areatrabajo,id'
        ];
    }
}
