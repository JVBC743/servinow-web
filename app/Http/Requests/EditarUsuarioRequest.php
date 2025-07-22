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
            'nome' => 'max:50|sometimes|required|string',
            'email' =>'max:80|sometimes|required|string|email',
            'telefone' => 'max:15|sometimes|required|string',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:15360',
            'descricao' => 'max:300|sometimes|nullable|string  ',
            'area_atuacao' => 'sometimes|required|string',
            'cpf_cnpj' => 'max:14|sometimes|required|string',
            // 'rede_social1' => 'max:40|sometimes|nullable|string',
            // 'rede_social2' => 'max:40|sometimes|nullable|string',
            // 'rede_social3' => 'max:40|sometimes|nullable|string',
            // 'rede_social4' => 'max:40|sometimes|nullable|string',
            'cep' => 'sometimes|required|string',
            'logradouro' => 'sometimes|required|string',
            'numero' => 'sometimes|required|string',
            'complemento' => 'sometimes|nullable|string',
            'bairro' => 'sometimes|required|string',
            'cidade' => 'sometimes|required|string',
            'uf' => 'sometimes|required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo de nome de usuário é obrigatório.',

            'email.required' => 'O campo de e-mail de usuário é obrigatório.',
            'email.email' => 'O formato do e-mail inserido deve ser a de um e-mail válido.',

            'telefone.required' => 'O campo de telefone de usuário é obrigatório',

            // 'foto.required' => 'A foto de usuário é obrigatória.', Vou deixar comentado, por enquando.

            'foto.image' => 'O arquivo inserido deve ser uma foto em formato PNG, JPG ou JPEG.',
            'foto.mimes' => 'O arquivo inserido deve ser uma foto em formato PNG, JPG ou JPEG.',
            'foto.max' => 'A sua foto não deve possuir exceder de 15 MB de tamanho.',

            'descricao.max' => 'O tamanho da descrição de usuário deve ser igual ou menor do que 300 dígitos, o que inclui espaços.',


            'area_atuacao.required' => 'A sua área de atuação é obrigatória.',
            'cpf_cnpj.required' => 'O seu CPF ou CNPJ é obrigatório.',

            // 'rede_social1.max' => 'O link da sua rede social primária não deve exceder 40 digitos, o que inclui espaços,',
            // 'rede_social2.max' => 'O link da sua rede social secundária não deve exceder 40 digitos, o que inclui espaços',
            // 'rede_social3.max' => 'O link da sua rede social terciária não deve exceder 40 digitos, o que inclui espaços',
            // 'rede_social4.max' => 'O link da sua rede social quaternária não deve exceder 40 digitos, o que inclui espaços',

            'cep.required'         => 'O campo CEP é obrigatório.',
            'logradouro.required'  => 'O campo logradouro é obrigatório.',
            'numero.required'      => 'O campo número é obrigatório.',
            'complemento.required' => 'O campo complemento é obrigatório.',
            'bairro.required'      => 'O campo bairro é obrigatório.',
            'cidade.required'      => 'O campo cidade é obrigatório.',
            'uf.required'          => 'O campo UF é obrigatório.',
        ];
    }
}
