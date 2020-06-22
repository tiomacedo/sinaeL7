<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Credenciais extends Migration {

    public function up() {
        Schema::create('credenciais', function (Blueprint $table) {
            $table->increments('CREDEN_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('CREDEN_STATUS', 200);
            $table->date('CREDEN_DTEMISSAO');
            $table->date('CREDEN_DTVALIDADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('credenciais');
    }

}
