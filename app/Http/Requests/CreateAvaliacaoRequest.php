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
            'id_servico' => 'required,exists:Servico,id',
            'titulo' => 'required|max:25|min:10',
            'nota' => 'required',
            'comentario' => 'min:30|required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'id_servico.required' => 'Serviço não encontrado.',

            'titulo.max' => 'O título deve ter, no máximo, 33 digitos.',
            'titulo.min' => 'O título deve ter, no mínimo, 10 digitos.',
            'titulo.required' => 'O título é obrigatório.',

            'nota.required' => 'A nota deve ser obrigatória na avaliação',
            'comentario.required' => 'O comentário deve ser obrigatório',
            'comentario.max' => 'O comentário deve ter, no máximo, 100 digitos.',
            'comentario.min' => 'O comentário deve ter, no mínimo, 30 digitos.',
        ];
    }
}
