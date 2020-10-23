<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('operacao');
            $table->text('descricao');

            // $table->unsignedInteger('user_id')->index();
            // $table->foreign('user_id')->references('id')->on('users');

            // $table->unsignedInteger('solicitacao_id')->index();
            // $table->foreign('solicitacao_id')->references('id')->on('solicitacaos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentos');
    }
}
