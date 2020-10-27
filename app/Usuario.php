<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Cargo;

class Usuario extends Model {

    protected $table = 'usuarios';

    protected $fillable = ['imagem', 'nome', 'cpf', 'rg', 'data_nascimento', 'matricula', 'cargo_id', 'email', 'senha'];

    public function getCargo($cargo_id) {
        return Cargo::find($cargo_id);
    }

}
