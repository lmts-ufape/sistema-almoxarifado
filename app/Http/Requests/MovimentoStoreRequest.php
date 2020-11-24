<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'material_id' => 'bail|required|numeric',
            'quantidade' => 'required|integer|min:0',
            // 'quantidade' => 'required',
            'deposito_id' => 'bail|required|numeric',
            'descricao' => 'required',
            'operacao' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'material_id.*' => 'É necessário selecionar um material',
            'quantidade.*' => 'É necessário fornecer uma quantidade',
            'deposito_id.*' => 'É necessário selecionar um depósito',
            'descricao.*' => 'A descrição é obrigatória',
        ];
    }
}
