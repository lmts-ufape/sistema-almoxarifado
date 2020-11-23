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
            'nome' => 'required|string|min:5|max:100',
            'email' => 'required|email|min:5|max:100|unique:usuarios',
            'cpf' => 'required|numeric|min:0|digits:11',
            'rg' => 'required|numeric|min:0|digits_between:7,11',
            'data_nascimento' => 'required|date',
            'matricula' => 'required|integer|min:0|min:1',
            'imagem' => 'required|image',
            'senha' => 'required|string|min:8',
            // 'senha' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return[
            'nome.required' => 'O nome é um campo obrigatório.',
            'nome.min' => 'O nome deve no mínimo 5 caracteres.',
            'email.required' => 'O e-mail é um campo obrigatório.',
            'email.min' => 'O email deve ter no mínimo 5 caracteres.',
            'email.unique' => 'Já existe um cadastro com o email fornecido.',
            'cpf.required' => 'O CPF é um campo obrigatório.',
            'cpf.min' => 'O CPF deve ter 11 dígitos.',
            'rg.required' => 'O RG é um campo obrigatório.',
            'rg.min' => 'O RG deve ter entre 7 e 11 dígitos.',
            'data_nascimento.*' => 'A data de nascimento é um campo obrigatório.',
            'matricula.*' => 'A matricula é um campo obrigatório.',
            'cargo.*' => 'Um cargo deve ser selecionado.',
            'imagem.*' => 'O carregamento de uma imagem é obrigatória.',
            'senha.required' => 'A senha é um campo obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'confirmar_senha.required' => 'A confirmação da senha é obrigatória e deve ser igual a senha inserida.'
        ];
    }
}
