<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnderecosUsuarios extends Migration {

    public function up() {
        Schema::create('enderecos_usuarios', function (Blueprint $table) {
            $table->increments('ENDUSER_CODIGO');
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('END_CODIGO')->unsigned();
            $table->foreign('END_CODIGO')->references('END_CODIGO')->on('enderecos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('enderecos_usuarios');
    }

}
