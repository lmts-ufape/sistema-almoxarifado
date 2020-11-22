<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositoStore extends FormRequest
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
            'nome' => 'bail|required|min:1|max:50',
            'codigo' => 'bail|required|min:1|max:20'
        ];
    }

    public function messages()
    {
        return[
            'nome.*' => 'O nome do depósito é obrigatório',
            'codigo.*' => 'O código de identificação é obrigatório'
        ];
    }
}
