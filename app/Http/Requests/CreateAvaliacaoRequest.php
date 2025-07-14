<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAvaliacaoRequest extends FormRequest
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
            'id_servico' => 'required',
            'titulo' => 'max:33|min:10',
            'nota' => 'required',
            'comentario' => 'min:30|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'id_servico' => 'Serviço não encontrado',
            'titulo' => 'O título deve ser ',
            'nota' => 'A nota deve ser obrigatória na avaliação',
            'comentario' => 'O comentário deve ser obrigatório',
        ];
            
    }
}
