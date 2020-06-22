<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitacoes extends Migration {

    public function up() {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->increments('SOL_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('SOL_PEDIDO');
            $table->string('SOL_STATUS', 25);
            $table->text('SOL_RESPOSTA');
            $table->char('SOL_CHECK', 1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('dados_bancarios');
    }

}
