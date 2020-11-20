<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estoque;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Estoque::class, function (Faker $faker) {
    $depositos = DB::select("select * from depositos");
    return [
        'material_id' => 1,
        'deposito_id' => rand(1, count($depositos)),
        'quantidade' => rand(50, 100),
    ];
});
