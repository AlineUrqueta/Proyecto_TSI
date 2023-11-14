<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DigitoVerificador implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function calcularDigitoVerificador($rut)
    {
       
        if (!preg_match('/^\d{7,8}-[\dkK]$/', $rut)) {
            return false; 
        }

        list($numeroRut, $digitoVerificador) = explode('-', $rut);

        if (strlen($numeroRut) < 7 || strlen($numeroRut) > 8) {
            return false; 
        }

        $reversedRut = strrev($numeroRut);

        $suma = 0;
        $multiplicador = 2;

        for ($i = 0; $i < strlen($reversedRut); $i++) {
            $suma += $reversedRut[$i] * $multiplicador;
            $multiplicador = ($multiplicador == 7) ? 2 : $multiplicador + 1;
        }

        $digitoVerificadorCalculado = 11 - ($suma % 11);

        if ($digitoVerificadorCalculado == 11) {
            $digitoVerificadorCalculado = 0;
        } elseif ($digitoVerificadorCalculado == 10) {
            $digitoVerificadorCalculado = 'K';
        }
        return $digitoVerificadorCalculado == $digitoVerificador;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $resultado = $this->calcularDigitoVerificador($value);
        if ($resultado === false) {
            $fail('El dígito verificador no es válido.');
        }

    }
}
