<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DadosBancarios extends Migration {

    public function up() {
        Schema::create('dados_bancarios', function (Blueprint $table) {
            $table->increments('BAN_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('BAN_NOME', 50);
            $table->string('BAN_AGENCIA', 7);
            $table->string('BAN_CONTA', 20);
            $table->string('BAN_TIPOCONTA', 20);
            $table->string('BAN_VARIACAO', 5);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('dados_bancarios');
    }

}
