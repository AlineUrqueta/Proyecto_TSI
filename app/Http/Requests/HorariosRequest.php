<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorariosRequest extends FormRequest
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
            'rut_profesional'=>'required',
            'dia'=>'required',
            'hora_inicio'=>'required',
            'hora_fin'=>'required',
            'rut_profesional' => 'unique:disponibilidad,rut_profesional,NULL,NULL,hora_inicio,' . $this->input('hora_inicio') . ',hora_fin,' . $this->input('hora_fin'),
            'hora_inicio' => 'unique:disponibilidad,hora_inicio,NULL,NULL,rut_profesional,' . $this->input('rut_profesional') . ',hora_fin,' . $this->input('hora_fin'),
            'hora_fin' => 'unique:disponibilidad,hora_fin,NULL,NULL,rut_profesional,' . $this->input('rut_profesional') . ',hora_inicio,' . $this->input('hora_inicio'),
        ];
    }

    public function messages(){
        return [
            'rut_profesional.required' => 'Indique profesional',
            'dia.required' => 'Indique dia',
            'hora_inicio.required' => 'Indique hora inicio',
            'hora_fin.required' => 'Indique hora termino',
            'rut_profesional.unique'=>'Esta disponibilidad ya fue registrada',
            'hora_inicio.unique'=>'Esta disponibilidad ya fue registrada',
            'hora_fin.unique'=>'Esta disponibilidad ya fue registrada',
            
        ];
    }
}
