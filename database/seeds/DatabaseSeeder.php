<?php

use App\Cargo;
use App\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $cargoRequerente = new Cargo();
        $cargoRequerente->nome = 'requerente';
        $cargoRequerente->save();

        $cargoAdm = new Cargo();
        $cargoAdm->nome = 'administrador';
        $cargoAdm->save();

        $admTeste = new Usuario([
            'imagem' => 'adm.jpg',
            'nome' => 'administrador',
            'cpf' => '00000000000',
            'rg' => '11111111111',
            'data_nascimento' => '01/02/2000',
            'matricula' => '222222222',
            'cargo_id' => '2',
            'email' => 'admin@admin.teste',
            'senha' => '$2y$10$ZGZg6dMzSYegqGT.lKN6deaVsxnMFidwq9Z5f7t3ytaDQ6UE70zFi'
        ]);
        $admTeste->save();




    }
}
