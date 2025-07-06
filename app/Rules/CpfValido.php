<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValido implements ValidationRule
{
    /**
     * Valida um CPF real (sem máscara e com 11 dígitos).
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $value);

        // CPF precisa ter 11 dígitos
        if (strlen($cpf) !== 11) {
            $fail('O CPF deve conter 11 dígitos.');
            return;
        }

        // Rejeita CPFs com todos os dígitos iguais (ex: 00000000000)
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            $fail('O CPF informado não é válido.');
            return;
        }

        // Valida dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $digito = ((10 * $d) % 11) % 10;

            if ($cpf[$t] != $digito) {
                $fail('O CPF informado não é válido.');
                return;
            }
        }
    }
}
