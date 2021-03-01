<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('mensagem');
            $table->integer('material_quant');
            $table->boolean('visto')->default(false);

            $table->unsignedInteger('usuario_id')->index();
            $table->foreign('usuario_id')->references('id')->on('usuarios');

            $table->unsignedInteger('material_id')->index();
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacaos');
    }
}
