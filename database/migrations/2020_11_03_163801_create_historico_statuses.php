<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('observacao')->nullable();
            $table->unsignedInteger('solicitacao_id')->index();
            $table->foreign('solicitacao_id')->references('id')->on('solicitacaos');
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
        Schema::dropIfExists('historico_statuses');
    }
}
