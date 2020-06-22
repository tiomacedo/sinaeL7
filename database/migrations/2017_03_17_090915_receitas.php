<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Receitas extends Migration {

    public function up() {
        Schema::create('receitas', function (Blueprint $table) {
            $table->increments('REC_CODIGO');
            $table->integer('TR_CODIGO')->unsigned();
            $table->foreign('TR_CODIGO')->references('TR_CODIGO')->on('tipos_receitas')->onDelete('cascade');
            $table->integer('user_id')->nullable();
            $table->integer('REC_COLETOR')->nullable();
            $table->date('REC_DTLANCAMENTO');
            $table->date('REC_DTREFERENCIA')->nullable();
            $table->date('REC_DTVENCIMENTO')->nullable();
            $table->date('REC_DTRECEBIMENTO')->nullable();
            $table->float('REC_VALOR', 10, 2);
            $table->float('REC_VALORRECEBIDO', 10, 2)->nullable();
            $table->string('REC_NOSSONUMERO', 20)->nullable()->unique();
            $table->string('REC_NUMERODOCUMENTO', 20)->nullable()->unique();
            $table->string('COMPLEMENTO', 200)->nullable();
            $table->string('REC_STATUS', 50)->nullable();
            $table->string('REC_COMPROVANTE', 120)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('receitas');
    }

}
