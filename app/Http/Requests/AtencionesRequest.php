<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class AtencionesRequest extends FormRequest
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
        $fecha_actual = Carbon::now();
        return [
            'rut_paciente_atenciones'=>'sometimes|required',
            'rut_profesional_atenciones'=>'required',
            'fecha_atencion'=>'required|date|after:'.$fecha_actual,
            'hora_inicio'=>'required',
            'hora_fin'=>'required',
        ];
    }

    public function messages(){
        return [
            'rut_paciente_atenciones.required'=>'Seleccione paciente',
            'rut_profesional_atenciones.required'=>'Seleccione profesional',
            'fecha_atencion.required'=>'Indique fecha',
            'fecha_atencion.after'=>'La fecha debe ser posterior a la actual',
            'hora_inicio.required'=>'Indique hora de inicio',
            'hora_fin.required'=>'Indique hora de fin',   
        ];
    }
}
