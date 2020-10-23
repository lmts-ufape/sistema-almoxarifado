<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMovimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_movimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantidade');

            $table->unsignedInteger('material_id')->index();
            $table->foreign('material_id')->references('id')->on('materials');

            $table->unsignedInteger('estoque_id')->index();
            $table->foreign('estoque_id')->references('id')->on('estoques');

            $table->unsignedInteger('movimento_id');
            $table->foreign('movimento_id')->references('id')->on('movimentos');

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
        Schema::dropIfExists('item_movimentos');
    }
}
