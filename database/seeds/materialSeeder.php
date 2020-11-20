<?php

use Illuminate\Database\Seeder;

class materialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\material::class, 50)->create();
    }
}
