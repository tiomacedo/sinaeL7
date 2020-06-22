<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnderecosIgrejas extends Migration {

    public function up() {
        Schema::create('enderecos_igrejas', function (Blueprint $table) {
            $table->increments('ENDIGR_CODIGO');
            $table->integer('IGR_CODIGO')->unsigned();
            $table->foreign('IGR_CODIGO')->references('IGR_CODIGO')->on('igrejas')->onDelete('cascade');
            $table->integer('END_CODIGO')->unsigned();
            $table->foreign('END_CODIGO')->references('END_CODIGO')->on('enderecos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('enderecos_igrejas');
    }

}
