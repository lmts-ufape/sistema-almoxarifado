<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    public static $rules = [
        'nome' => 'bail|required|min:3|max:50',
        'codigo' => 'bail|required|min:1|max:20',
    ];

    public static $messages = [
        'nome.required' => 'O nome do depósito é obrigatório',
        'nome.min' => 'O nome do depósito deve ter no mínimo 3 caracteres.',
        'nome.max' => 'O nome do depósito deve ter no máximo 50 caracteres.',
        'codigo.required' => 'O código do depósito é obrigatório',
        'codigo.min' => 'O código do depósito deve ter no mínimo 1 caractere.',
        'codigo.max' => 'O código do depósito deve ter no máximo 20 caracteres.',
    ];

    protected $table = 'depositos';

    protected $fillable = ['nome', 'codigo'];

    public function estoques()
    {
        $this->hasMany('App\Estoque');
    }
}
