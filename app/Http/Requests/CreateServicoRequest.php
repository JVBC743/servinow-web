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
            'descricao' => 'max:750',
            'categoria' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:15360',

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

            'foto.image' => 'O arquivo inserido deve ser uma foto em formato PNG, JPG ou JPEG.',
            'foto.mimes' => 'O arquivo inserido deve ser uma foto em formato PNG, JPG ou JPEG.',
            'foto.max' => 'A sua foto não deve possuir exceder de 15 MB de tamanho.',

            '' => '',
        ];
        
    }
}
