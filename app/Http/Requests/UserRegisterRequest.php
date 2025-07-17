<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use App\Rules\CpfValido;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf_cnpj' => preg_replace('/\D/', '', $this->cpf_cnpj),
            'telefone' => preg_replace('/\D/', '', $this->telefone),
        ]);
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:50',
            'cpf_cnpj' => ['required', 'string', 'size:11', 'unique:Usuario,cpf_cnpj', new CpfValido],
            'data_nascimento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (\Carbon\Carbon::parse($value)->age < 18) {
                        $fail('Você deve ter pelo menos 18 anos para se cadastrar.');
                    }
                },
            ],
            'email' => 'required|email|max:80|unique:Usuario,email',
            'telefone' => 'required|string|max:20|unique:Usuario,telefone',

            'cep' => 'required|string|max:10',
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:50',
            'bairro' => 'required|string|max:50',
            'cidade' => 'required|string|max:50',
            'uf' => 'required|string|size:2',

            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O nome deve ser um texto.',
            'nome.max' => 'O nome não pode ter mais de 50 caracteres.',

            'cpf_cnpj.required' => 'O CPF é obrigatório.',
            'cpf_cnpj.string' => 'O CPF deve ser um texto.',
            'cpf_cnpj.size' => 'O CPF deve ter exatamente 11 números.',
            'cpf_cnpj.unique' => 'Este CPF já está em uso.',

            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date' => 'A data de nascimento deve ser uma data válida.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.max' => 'O e-mail não pode ter mais de 80 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',

            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.string' => 'O telefone deve ser um texto.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'telefone.unique' => 'O telefone inserido já existe no banco. Insira outro.',

            'cep.required' => 'O CEP é obrigatório.',
            'cep.string' => 'O CEP deve ser um texto.',
            'cep.max' => 'O CEP não pode ter mais de 10 caracteres.',

            'logradouro.required' => 'O logradouro é obrigatório.',
            'logradouro.string' => 'O logradouro deve ser um texto.',
            'logradouro.max' => 'O logradouro não pode ter mais de 100 caracteres.',

            'numero.required' => 'O número é obrigatório.',
            'numero.string' => 'O número deve ser um texto.',
            'numero.max' => 'O número não pode ter mais de 10 caracteres.',

            'complemento.string' => 'O complemento deve ser um texto.',
            'complemento.max' => 'O complemento não pode ter mais de 50 caracteres.',

            'bairro.required' => 'O bairro é obrigatório.',
            'bairro.string' => 'O bairro deve ser um texto.',
            'bairro.max' => 'O bairro não pode ter mais de 50 caracteres.',

            'cidade.required' => 'A cidade é obrigatória.',
            'cidade.string' => 'A cidade deve ser um texto.',
            'cidade.max' => 'A cidade não pode ter mais de 50 caracteres.',

            'uf.required' => 'A UF é obrigatória.',
            'uf.string' => 'A UF deve ser um texto.',
            'uf.size' => 'A UF deve ter exatamente 2 caracteres.',

            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ];
    }
}
