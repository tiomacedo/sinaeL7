<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('IGR_CODIGO')->unsigned();
            $table->foreign('IGR_CODIGO')->references('IGR_CODIGO')->on('igrejas')->onDelete('cascade');
            $table->integer('CID_CODIGO')->unsigned();
            $table->foreign('CID_CODIGO')->references('CID_CODIGO')->on('cidades')->onDelete('cascade');
            $table->integer("user_id", false, true)->nullable();
            $table->index("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('matricula', 20);
            $table->string('name', 120);
            $table->string('foto', 255)->nullable();
            $table->date('dtnascimento');
            $table->string('cpf', 14);
            $table->string('rg', 30);
            $table->string('pai', 200);
            $table->string('mae', 200);
            $table->string('estadocivil', 20);
            $table->string('conjuge', 200);
            $table->string('confirmacao_casal', 12)->nullable();
            $table->date('dtcasamento')->nullable();
            $table->date('dtviuvez')->nullable();
            $table->string('nacionalidade', 20);
            $table->string('escolaridade', 30);
            $table->string('phone', 14);
            $table->string('cellphone', 14);
            $table->string('cellphone2', 14);
            $table->char('tp', 3);
            $table->char('tx_mensal', 3)->nullable();
            $table->char('tx_obreiro', 3)->nullable();
            $table->char('tx_dizimo', 3)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->char('sexo', 1);
            $table->string('titulo_eleitoral', 30)->nullable();
            $table->string('profissao', 200);
            //$table->enum('taxas',['mensalidade','dízimo obreiros','dízimo dos dízimos']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('users');
    }

}
