<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notificacao;
use Faker\Generator as Faker;

$factory->define(Notificacao::class, function (Faker $faker) {
    $materiais = count(\App\Material::all());
    $material = rand(1, $materiais);
    $estoque = \App\Estoque::all()->where('material_id', '=', $material->id);
    return [
        'mensagem' => 'Caneta em estado critico!',
        'visto' => false,
        'material_id' => $material,
        'material_quant' => $estoque->quant,
    ];
});
