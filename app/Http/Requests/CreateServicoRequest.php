<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServicoRequest extends FormRequest
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
            'nome' => 'max:40|min:20|required',
            'preco' => 'required|numeric|min:0|max:999999.99',
            'descricao' => 'max:750',
            'categoria' => 'required',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        
        ];
    }

    public function messages(): array
    {
        return [

            'nome.required' => 'O serviço tem que ter um nome.',
            'nome.max' => 'O nome do serviço não pode exceder 40 dígitos, o que inclui espaços.',
            'nome.min' => 'O nome do serviço não deve possuir menos de 20 digitos.',

            'descricao.max' => 'A descrição do serviço não deve exceder 750 caracteres, o que inclui espaços.',

            'categoria.required' => 'O seu serviço não pode possui nenhuma categoria.',

            'imagem.image' => 'O arquivo inserido deve ser uma foto em formato PNG, JPG ou JPEG.',
            'imagem.mimes' => 'O arquivo inserido deve ser uma foto em formato PNG, JPG ou JPEG.',
            'imagem.max' => 'A sua foto não deve possuir exceder de 2 MB de tamanho.',

            'preco.required' => 'O preço do seu serviço deve estar presente.',
            'preco.numeric' => 'O campo de preço deve possuir apenas números.',
            'preco.max' => 'O preço máximo do seu serviço.'

        ];
    }
}
