<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferenciaStoreRequest extends FormRequest
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
            'deposito_id_origem' => 'bail|required|numeric',
            'deposito_id_destino' => 'bail|required|numeric',
            'descricao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'material_id.*' => 'É necessário selecionar um material',
            'quantidade.*' => 'É necessário fornecer uma quantidade',
            'deposito_id_origem.*' => 'É necessário selecionar um depósito de origem',
            'deposito_id_destino.*' => 'É necessário selecionar um depósito de destino',
            'descricao.*' => 'A descrição é obrigatória',
        ];
    }
}
