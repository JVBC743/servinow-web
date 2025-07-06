<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
            'telefone' => 'required|string|max:50',
            'email' => 'required|email|max:80|unique:Usuario,email',
            'cpf_cnpj' => 'required|string|size:14|unique:Usuario,cpf_cnpj',
            // 'area_atuacao' => 'required|integer|exists:areas,id',

            'data_nascimento' => 'required|date',
            'cep' => 'required|string|max:10',
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:50',
            'bairro' => 'required|string|max:50',
            'cidade' => 'required|string|max:50',
            'uf' => 'required|string|size:2',

            'descricao' => 'nullable|string',
            'caminho_img' => 'nullable|string|max:60',

            'rede_social1' => 'nullable|string|max:40',
            'rede_social2' => 'nullable|string|max:40',
            'rede_social3' => 'nullable|string|max:40',
            'rede_social4' => 'nullable|string|max:40',
        ];
    }


    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O nome deve ser um texto.',
            'nome.max' => 'O nome não pode ter mais de 50 caracteres.',

            'senha.required' => 'O campo senha é obrigatório.',
            'senha.string' => 'A senha deve ser um texto.',
            'senha.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'senha.confirmed' => 'A confirmação da senha não confere.',

            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.string' => 'O telefone deve ser um texto.',
            'telefone.max' => 'O telefone não pode ter mais de 50 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.max' => 'O e-mail não pode ter mais de 80 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',

            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.string' => 'O CPF/CNPJ deve ser um texto.',
            'cpf_cnpj.size' => 'O CPF/CNPJ deve ter exatamente 14 caracteres.',
            'cpf_cnpj.unique' => 'Este CPF ou CNPJ já está em uso.',

            'area_atuacao.required' => 'A área de atuação é obrigatória.',
            'area_atuacao.integer' => 'A área de atuação deve ser um número.',
            'area_atuacao.exists' => 'A área de atuação selecionada é inválida.',

            'descricao.string' => 'A descrição deve ser um texto.',

            'caminho_img.string' => 'O caminho da imagem deve ser um texto.',
            'caminho_img.max' => 'O caminho da imagem não pode ter mais de 60 caracteres.',

            'rede_social1.string' => 'O campo rede social 1 deve ser um texto.',
            'rede_social1.max' => 'A rede social 1 não pode ter mais de 40 caracteres.',

            'rede_social2.string' => 'O campo rede social 2 deve ser um texto.',
            'rede_social2.max' => 'A rede social 2 não pode ter mais de 40 caracteres.',

            'rede_social3.string' => 'O campo rede social 3 deve ser um texto.',
            'rede_social3.max' => 'A rede social 3 não pode ter mais de 40 caracteres.',

            'rede_social4.string' => 'O campo rede social 4 deve ser um texto.',
            'rede_social4.max' => 'A rede social 4 não pode ter mais de 40 caracteres.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date' => 'A data de nascimento deve ser uma data válida.',

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

        ];
    }
}
