<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiposReceitas extends Migration {

    public function up() {
        Schema::create('tipos_receitas', function (Blueprint $table) {
            $table->increments('TR_CODIGO');
            $table->string('TR_DESCRICAO', 120);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('tipos_receitas');
    }

}
