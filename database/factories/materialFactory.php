<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\material;
use Faker\Generator as Faker;

$factory->define(material::class, function (Faker $faker) {
    $faker = \Faker\Factory::create();
    \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
    return [
        'nome' => $faker->productName,
        'codigo' => rand(000000, 999999),
        'descricao' => $faker->text,
        'quantidade_minima' => rand(0, 50)
    ];
});
