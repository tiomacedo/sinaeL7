<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DadosEclesiaticosMissionarias extends Migration {

    public function up() {
        Schema::create('dados_eclesiaticos_missionarias', function (Blueprint $table) {
            $table->increments('DEM_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('DEM_ATIVIDADE', 30);
            $table->string('DEM_SITUACAO', 30);
            $table->string('DEM_CURSOTEOLOGICO', 20);
            $table->string('DEM_NOMECONSELHO', 80)->nullable();
            $table->string('DEM_FUNCAOCONSELHO', 80)->nullable();
            $table->date('DEM_DTFILIACAO')->nullable();
            $table->date('DEM_DTRECEBIDO')->nullable();
            $table->string('DEM_IGREJADEORIGEM', 80)->nullable();
            $table->char('DEM_NATIVO', 3);
            $table->string('DEM_CONVENCAODEORIGEM', 80)->nullable();
            $table->date('DEM_DTMUDANCA')->nullable();
            $table->char('DEM_REINTEGRADO', 3);
            $table->date('DEM_DTCONVERSAO')->nullable();
            $table->date('DEM_DTCONGREGADODESDE')->nullable();
            $table->date('DEM_DTBATISMOAGUA')->nullable();
            $table->date('DEM_DTBATISMOESPIRITO')->nullable();
            $table->date('DEM_DTDESLIGAMENTO')->nullable();
            $table->string('DEM_MOTIVODESLIGAMENTO', 120)->nullable();
            $table->string('DEM_DEPARTAMENTOIGREJA', 60)->nullable();
            $table->date('DEM_DTDEPARTAMENTOIGREJA')->nullable();
            $table->string('DEM_FUNCAODEPARTAMENTOIGREJA', 60)->nullable();
            $table->string('DEM_OBSERVACAO', '500');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('dados_eclesiaticos_missionarias');
    }

}
