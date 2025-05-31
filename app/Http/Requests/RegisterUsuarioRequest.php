<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'telefone' => 'required|string',
            'cpf_cnpj' => 'required|string',
            'area_atuacao_id' => 'required|integer|exists:formacoes,id',
        ];
    }
}
