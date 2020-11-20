<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Usuario;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Usuario::class, function (Faker $faker) {
    return [
        'imagem' => 'user.jpg',
        'nome' => $faker->name,
        'cpf' => rand(10000000000, 99999999999),
        'rg' => rand(100000000, 999999999),
        'data_nascimento' => $faker->date('d-m-Y'),
        'matricula' => rand(100000, 999999),
        'cargo_id' => 1,
        'email' => $faker->email,
        'senha' => Hash::make('password'),
    ];
});
