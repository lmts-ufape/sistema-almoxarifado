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

    public function messages()
    {
        return[
            'nome.*' => 'O nome é um campo obrigatório, e deve ter entre 5 e 100 caracteres',
            'email.*' => 'O email é um campo unico e obrigatório, e deve ter entre 5 e 100 caracteres',
            'cpf.*' => 'O cpf é um campo obrigatório e deve ter 11 dígitos',
            'rg.*' => 'O rg é um campo obrigatório e deve ter entre 8 e 11 dígitos',
            'data_nascimento.*' => 'A data de nascimento é um campo obrigatório',
            'matricula.*' => 'A matricula é um campo obrigatório e deve ter pelo menos 1 dígito',
            'cargo.*' => 'Um cargo deve ser selecionado',
            'imagem.*' => 'O imagem é obrigatória',
            'senha.*' => 'A senha é um campo obrigatório, e deve ter no mínimo 8 caracteres',
            'confirmar_senha.*' => 'Confirmação de senha necessária e deve ser igual a senha inserida'
        ];
    }
}
