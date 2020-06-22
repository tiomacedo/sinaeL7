<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dependentes extends Migration {

    public function up() {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->increments('DEP_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('DEP_NOME', 150);
            $table->string('DEP_GRAUPARENTESCO', 40);
            $table->date('DEP_DATANASCIMENTO');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('dependentes');
    }

}
