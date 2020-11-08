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
            'imagem' => 'required|file|image',
            'nome' => 'required|', // N
            'cpf' => 'required|numeric|min:1000000000',
            'rg' => 'required|numeric|min:100000',
            'data_nascimento' => 'required|date',
            'matricula' => 'required|integer|min:1',
            'cargo' => 'required|integer|min:1',
            'email' => 'required|email',
            'senha' => 'required|min:8', // N
            'confirmar_senha' => 'required|min:8', // N
        ];
    }
}
