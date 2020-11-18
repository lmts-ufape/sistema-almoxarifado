<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;


$factory->define(App\Deposito::class, function (Faker $faker) {
    $faker = \Faker\Factory::create();
    \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
    $codigo = rand(100000, 999999);
    return [
        'nome' => $faker->department,
        'codigo' => $codigo
    ];
});
