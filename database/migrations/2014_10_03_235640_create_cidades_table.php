<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration {

    public function up() {
        Schema::create('cidades', function (Blueprint $table) {
            $table->increments('CID_CODIGO');
            $table->string('CID_NOME', 120);
            $table->char('CID_UF', 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('cidades');
    }

}
