<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiposDebitos extends Migration {

    public function up() {
        Schema::create('tipos_debitos', function (Blueprint $table) {
            $table->increments('TD_CODIGO');
            $table->string('TD_DESCRICAO', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('tipos_debitos');
    }

}
