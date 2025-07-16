<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgendamentoRequest extends FormRequest
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
            'data' => 'required|date_format:Y-m-d|after_or_equal:today',
            'descricao' => 'max:50|min:20|required',
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'Você deve inserir uma data para o agendamento.',
            'data.date_format' => 'O formato da data deve ser o padrão brasileiro',
            'data.after_or_equal' => 'O agendamento deve ser feito hoje ou depois.',
            'descricao.required' => 'A descrição da sua solicitação é obrigatória.',
            'descricao.min' => 'A descrição deve ter, no mínimo, 20 digitos.',
            'descricao.max' => 'A descrição deve ter, no máximo, 50 digitos.',
            
        ];
    }
}
