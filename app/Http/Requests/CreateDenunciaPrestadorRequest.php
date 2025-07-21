<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDenunciaPrestadorRequest extends FormRequest
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

            'titulo' => 'required|max:30|min:10',
            'motivo' => 'required',
            'anexo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'descricao' => 'nullable|max:300|min:50',

        ];
    }
    public function messages(): array
    {
        return [

            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título deve ter, no máximo, 30 caracteres.',
            'titulo.min' => 'O título deve ter, no mínimo, 10 caracteres.',
            'motivo.required' => 'O motivo da sua denúncia é obrigatório.',

            'descricao.max' => 'A descrição deve ter, no máximo, 300 caracteres.',
            'descricao' => 'A descrição deve ter, no mínimo, 50 caracteres.',
            
        ];
    }
}