<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadRequest extends FormRequest
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
            'nom_especialidad'=>'required|min:5|max:25|unique:especialidades|'
        ];
    }

    public function messages():array{
        return [
            'nom_especialidad.required'=> 'Indique especialidad',
            'nom_especialidad.min'=> 'Especialidad debe tener mínimo 5 caracteres',
            'nom_especialidad.max'=> 'Especialidad debe tener máximo 25 caracteres',
            'nom_especialidad.unique'=> 'Especialidad " :input " ya está ingresada',
        ];
    }
}
