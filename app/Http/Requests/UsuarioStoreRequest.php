<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
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
            'imagem' => 'required|file|image',  // Feito
            'nome' => 'required|',              // N
            'cpf' => 'required|size:11',        // N
            'rg' => 'required|size:8',          // N
            'data_nascimento' => 'required|date', // Feito
            'matricula' => 'required|integer',  // Feito
            'cargo' => 'required|integer',      // Feito
            'email' => 'required|',             // N
            'senha' => 'required|',             // N
        ];
    }
}
