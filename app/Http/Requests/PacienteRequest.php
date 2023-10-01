<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'rut_paciente' => 'required|unique:pacientes',
            'nom_paciente' => 'required|min:3|max:50',
            'apep_paciente' => 'required|min:4|max:50',
            'apem_paciente' => 'required|min:4|max:50',
            'fono' => 'required|min:9|max:13',
            'fecha_nacimiento' => 'required',
            'corp_tea' => 'required',
        ];
    }

    public function messages(){
        return [
            'rut_paciente.required' => 'Indique RUT',
            'rut_paciente.unique' => 'El RUT ya se encuentra registrado',
            'nom_paciente.required' => 'Indique su nombre',
            'nom_paciente.min' => 'Nombre  debe tener como mínimo 3 letras',
            'nom_paciente.max' => 'Nombre  debe tener como máximo 50 letras',
            'apep_paciente.required' => 'Indique su apellido paterno',
            'apep_paciente.min' => 'Apellido paterno debe tener como mínimo 4 letras',
            'apep_paciente.max' => 'Apellido paterno debe tener como máximo 50 letras',
            'apem_paciente.required' => 'Indique su apellido materno',
            'apem_paciente.min' => 'Apellido materno debe tener como mínimo 4 letras',
            'apem_paciente.max' => 'Apellido materno debe tener como máximo 50 letras',
            'fono.required'=> 'Indique su numero de celular',
            'fono.min' => 'Celular debe tener como mínimo 9 numeros',
            'fono.max' => 'Celular debe tener como máximo 13 numeros',
            'fecha_nacimiento.required'=> 'Indique su fecha de nacimiento',
            'corp_tea.required'=> 'Indique si pertenece o no a la Corporación TEA', 
        ];
    }
}
