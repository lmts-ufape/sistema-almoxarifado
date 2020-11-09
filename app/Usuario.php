<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Cargo;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable {

    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = ['imagem', 'nome', 'cpf', 'rg', 'data_nascimento', 'matricula', 'cargo_id', 'email', 'senha'];

    protected $hidden = [
        'senha', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCargo($cargo_id) {
        return Cargo::find($cargo_id);
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
