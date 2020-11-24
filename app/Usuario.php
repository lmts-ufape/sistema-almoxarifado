<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Cargo;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{

    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = ['imagem', 'nome', 'cpf', 'rg', 'data_nascimento', 'matricula', 'cargo_id', 'email', 'senha'];

    protected $hidden = [
        'senha', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'nome' => 'required|string|min:5|max:100',
        'email' => 'required|email|min:5|max:100',
        'cpf' => 'required|numeric|min:0|digits:11',
        'rg' => 'required|numeric|min:0|digits_between:7,11',
        'data_nascimento' => 'required|date',
        'matricula' => 'required|integer|min:0|min:1',
        'imagem' => 'required|image',
        'password' => 'required|string|min:8|confirmed',
    ];

    public static $messages = [
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
        'password.required' => 'A senha é um campo obrigatório.',
        'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        'password.confirmed' => 'A confirmação da senha é obrigatória e deve ser igual a senha inserida.',
    ];

    public function getCargo($cargo_id)
    {
        return Cargo::find($cargo_id);
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
