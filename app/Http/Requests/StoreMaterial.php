<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterial extends FormRequest
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
            'nome' => 'bail|min:3|required|max:50',
            'codigo' => 'bail|min:1|required|max:20',
            'quantidade_minima' => 'required',
            'descricao' => 'bail|min:5|required|max:255',
            // 'imagem' => 'nullable'
        ];
    }
}
