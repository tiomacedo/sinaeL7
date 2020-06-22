<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration {

    public $incrementing = false;

    public function up() {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('ARE_CODIGO');
            $table->string('ARE_CODIGOMANUAL', 10)->unique();
            $table->string('ARE_DESCRICAO', 500);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('areas');
    }

}
