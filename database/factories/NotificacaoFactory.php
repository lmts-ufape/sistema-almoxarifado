<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notificacao;
use Faker\Generator as Faker;

$factory->define(Notificacao::class, function (Faker $faker) {
    $materiais = count(\App\Material::all());
    return [
        'mensagem' => 'Caneta em estado critico!',
        'visto' => false,
        'material_id' => rand(1, $materiais),
    ];
});
