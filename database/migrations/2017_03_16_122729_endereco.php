<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Endereco extends Migration {

    public function up() {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('END_CODIGO');
            $table->integer('CID_CODIGO')->unsigned();
            $table->foreign('CID_CODIGO')->references('CID_CODIGO')->on('cidades')->onDelete('cascade');
            $table->string('END_CEP', 10);
            $table->string('END_LOGRADOURO', 100);
            $table->string('END_TIPOLOGRADOURO', 20);
            $table->string('END_BAIRRO', 100);
            $table->string('END_COMPLEMENTO', 20);
            $table->string('END_NUMERO', 7);
            $table->string('END_DESCRICAOERRO', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('enderecos');
    }

}
