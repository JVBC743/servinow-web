<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarUsuarioRequest extends FormRequest
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
            'nome' =>  [
                'max:50',
            ],
            'email' => [
                'max:80',
            ],
            'telefone' => [
                'max:15',
            ],
            'atuacao' => [
                'max:40',
            ],
            'cpf_cnpj' => [
                'max:14'
            ],
            'rd1' => [
                'max:40'
            ],
            'rd2' => [
                'max:40'
            ],
            'rd3' => [
                'max:40'
            ],
            'rd4' => [
                'max:40'
            ],
        ];
    }
}
