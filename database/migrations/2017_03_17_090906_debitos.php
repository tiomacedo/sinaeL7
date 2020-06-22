<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Debitos extends Migration {

    public function up() {
        Schema::create('debitos', function (Blueprint $table) {
            $table->increments('DEB_CODIGO');
            $table->integer('TD_CODIGO')->unsigned();
            $table->foreign('TD_CODIGO')->references('TD_CODIGO')->on('tipos_debitos')->onDelete('cascade');
            $table->date('DEB_DTLANCAMENTO');
            $table->date('DEB_DTVENCIMENTO');
            $table->date('DEB_DTPAGAMENTO')->nullable();
            $table->float('DEB_VALOR', 10, 2);
            $table->string('COMPLEMENTO', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('debitos');
    }

}
