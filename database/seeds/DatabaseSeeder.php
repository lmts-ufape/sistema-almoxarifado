<?php

use App\Cargo;
use App\Usuario;
use App\Deposito;
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
        $this->call(CargoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(DepositoSeeder::class);
        $this->call(materialSeeder::class);
        $this->call(EstoqueSeeder::class);

    }
}
