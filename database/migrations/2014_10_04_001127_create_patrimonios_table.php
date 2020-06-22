<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoniosTable extends Migration {

    public function up() {
        Schema::create('patrimonios', function (Blueprint $table) {
            $table->increments('PAT_CODIGO');
            $table->string('PAT_TIPO', 70);
            $table->string('PAT_MARCA', 70);
            $table->float('PAT_VALOR', 10, 2);
            $table->date('PAT_DATAAQUISICAO');
            $table->integer('PAT_ANOSUTEIS');
            $table->string('PAT_ESTADO', 30);
            $table->string('PAT_LOCALIZACAO', 120);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('patrimonios');
    }

}
