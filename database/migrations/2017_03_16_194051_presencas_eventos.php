<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PresencasEventos extends Migration {

    public function up() {
        Schema::create('presencas_eventos', function (Blueprint $table) {
            $table->increments('PRESEN_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('even_codigo')->unsigned();
            $table->foreign('even_codigo')->references('even_codigo')->on('eventos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('presencas_eventos');
    }

}
