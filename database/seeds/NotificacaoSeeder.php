<?php

use Illuminate\Database\Seeder;

class NotificacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = count(\App\Usuario::all());
        for($i = 1; $i <= $usuarios; $i++){
            factory(\App\Notificacao::class, 2)->create(['usuario_id' => $i] );
        }
    }
}
