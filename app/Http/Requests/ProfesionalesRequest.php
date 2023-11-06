<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfesionalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rut_profesional' => 'required|unique:profesionales|regex:/^(\d{7,8}-[\dkK])$/',
            'nom_profesional' => 'required|min:3|max:50',
            'apep_profesional' => 'required|min:4|max:50',
            'apem_profesional' => 'required|min:4|max:50',
            'email'=>'required|min:10|max:60',
            'fono' => 'required|min:9|max:13',
            'id_especialidad'=>'required'
        ];
    }

    public function messages(){
        return [
            'rut_profesional.required' => 'Indique RUT',
            'rut_profesional.unique' => 'El RUT ya se encuentra registrado',
            'rut_profesional.regex' => 'Indique RUT sin puntos, con guión y dígito verificador',
            'nom_profesional.required' => 'Indique su nombre',
            'nom_profesional.min' => 'Nombre  debe tener como mínimo 3 letras',
            'nom_profesional.max' => 'Nombre  debe tener como máximo 50 letras',
            'apep_profesional.required' => 'Indique su apellido paterno',
            'apep_profesional.min' => 'Apellido paterno debe tener como mínimo 4 letras',
            'apep_profesional.max' => 'Apellido paterno debe tener como máximo 50 letras',
            'apem_profesional.required' => 'Indique su apellido materno',
            'apem_profesional.min' => 'Apellido materno debe tener como mínimo 4 letras',
            'apem_profesional.max' => 'Apellido materno debe tener como máximo 50 letras',
            'id_especialidad.required'=>'Indique especialidad',
            'fono.required'=> 'Indique su numero de celular',
            'fono.min' => 'Celular debe tener como mínimo 9 numeros',
            'fono.max' => 'Celular debe tener como máximo 13 numeros',
            'email.required'=> 'Indique email',
            'email.min' => 'Email debe tener como mínimo 10 letras',
            'email.max' => 'Email debe tener como máximo 60 letras',
        ];
    }
}
