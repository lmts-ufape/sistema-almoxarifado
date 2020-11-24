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
        'email' => 'required|email|min:5|max:100|unique:usuarios',
        'cpf' => 'required|numeric|min:0|digits_between:10,11',
        'rg' => 'required|numeric|min:0|digits_between:7,11',
        'data_nascimento' => 'required|date',
        'matricula' => 'required|integer|min:0|min:1',
        'imagem' => 'required|image',
        'password' => 'required|string|min:8|confirmed',
    ];

    public static $messages = [
        'nome.*' => 'O nome é um campo obrigatório, e deve ter entre 5 e 100 caracteres',
        'email.*' => 'O email é um campo unico e obrigatório, e deve ter entre 5 e 100 caracteres',
        'cpf.*' => 'O cpf é um campo obrigatório e deve ter 11 dígitos',
        'rg.*' => 'O rg é um campo obrigatório e deve ter entre 8 e 11 dígitos',
        'data_nascimento.*' => 'A data de nascimento é um campo obrigatório',
        'matricula.*' => 'A matricula é um campo obrigatório e deve ter pelo menos 1 dígito',
        'imagem.*' => 'O imagem é obrigatória',
        'password.*' => 'A senha é um campo obrigatório, e deve ter no mínimo 8 caracteres'
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
