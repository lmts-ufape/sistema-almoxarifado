<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Usuario::class, 1)->create(['email' => 'admin@admin.teste', 'cargo_id' => '2', 'nome' => 'administrador']);
        factory(\App\Usuario::class, 1)->create(['email' => 'requerente@admin.teste', 'cargo_id' => '1', 'nome' => 'requerente']);
        factory(\App\Usuario::class, 50)->create();
    }
}
