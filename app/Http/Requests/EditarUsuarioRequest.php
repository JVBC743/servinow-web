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
            'email' =>'max:80|sometimes|required|string',
            'telefone' => 'max:15|sometimes|required|string',
            'area_atuacao' => 'max:40|sometimes|required|string',
            'cpf_cnpj' => 'max:14|sometimes|required|string',
            'rd1' => 'max:40|sometimes|nullable|string',
            'rd2' => 'max:40|sometimes|nullable|string',
            'rd3' => 'max:40|sometimes|nullable|string',
            'rd4' => 'max:40|sometimes|nullable|string',
        ];
    }
}
