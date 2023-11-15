<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UsuarioRequest extends FormRequest
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
            'nom_usuario' => 'required|min:3|max:50',
            'apep_usuario' => 'required|min:4|max:50',
            'apem_usuario' => 'required|min:4|max:50',
            'fono' => 'required|min:9|max:13',
            'email' => 'sometimes|required|min:10|max:50|unique:usuarios',
            'password' => 'sometimes|required|min:8|max:64|confirmed',
            'id_tipo'=> 'sometimes' 
        ];
    }

    public function messages(){
        return [
            'nom_usuario.required' => 'Indique su nombre',
            'nom_usuario.min' => 'Nombre  debe tener como mínimo 3 letras',
            'nom_usuario.max' => 'Nombre  debe tener como máximo 50 letras',
            'apep_usuario.required' => 'Indique su apellido paterno',
            'apep_usuario.min' => 'Apellido paterno debe tener como mínimo 4 letras',
            'apep_usuario.max' => 'Apellido paterno debe tener como máximo 50 letras',
            'apem_usuario.required' => 'Indique su apellido materno',
            'apem_usuario.min' => 'Apellido materno debe tener como mínimo 4 letras',
            'apem_usuario.max' => 'Apellido materno debe tener como máximo 50 letras',
            'fono.required'=> 'Indique su numero de celular',
            'fono.min' => 'Celular debe tener como mínimo 9 numeros',
            'fono.max' => 'Celular debe tener como máximo 13 numeros',
            'email.required'=> 'Indique su email',
            'email.min' => 'Email debe tener como mínimo 10 caracteres',
            'email.max' => 'Email debe tener como máximo 50 caracteres',
            'email.unique' => 'Email ya se encuentra registrado',
            'password.required'=> 'Ingrese una contraseña',
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres',
            'password.max' => 'La contraseña debe tener máximo 64 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            
        ];
    }

}
