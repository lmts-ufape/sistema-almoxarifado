<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    public static $rules = [
        'material_id' => 'bail|required|numeric',
        'quantidade' => 'required|integer|min:1',
        'deposito_id_origem' => 'bail|required|numeric',
        'deposito_id_destino' => 'bail|required|numeric',
        'descricao' => 'required|min:5|max:255',
    ];

    public static $messages = [
        'material_id.required' => 'A escolha de um material é obrigatória',
        'material_id.numeric' => 'Escolha um material valido.',
        'quantidade.required' => 'A quantidade é obrigatória.',
        'quantidade.integer' => 'A quantidade é deve ser um número.',
        'quantidade.min' => 'A quantidade deve ter pelo menos uma unidade.',
        'deposito_id_origem.required' => 'Escolha de um depósito é obrigatório',
        'deposito_id_origem.numeric' => 'Escolha um depósito valido.',
        'deposito_id_destino.required' => 'Escolha de um depósito é obrigatório',
        'deposito_id_destino.numeric' => 'Escolha um depósito valido.',
        'descricao.min' => 'A descrição deve ter no mínimo 5 caracteres.',
        'descricao.max' => 'A descrição deve ter no máximo 255 caracteres.',
    ];
}
