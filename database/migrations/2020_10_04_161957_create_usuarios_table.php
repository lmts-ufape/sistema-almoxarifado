<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('imagem');
            $table->string('nome');
            $table->string('cpf');
            $table->string('rg');
            $table->date('data_nascimento');
            $table->integer('matricula');
            $table->foreignId('cargo_id');
            $table->string('email')->unique();
            $table->string('senha');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('cargo_id')->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
