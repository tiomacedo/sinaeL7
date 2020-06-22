<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eventos extends Migration {

    public function up() {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('EVEN_CODIGO');
            $table->string('EVEN_TITULO', 80);
            $table->text('EVEN_TEXTO');
            $table->string('EVEN_TIPO', 30);
            $table->date('EVEN_DTINICIO');
            $table->date('EVEN_DTFINAL');
            $table->string('EVEN_LOCAL', 600);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('eventos');
    }

}
