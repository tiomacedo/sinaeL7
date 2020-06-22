<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DadosEclesiaticosMinistros extends Migration {

    public function up() {
        Schema::create('dados_eclesiaticos_ministros', function (Blueprint $table) {
            $table->increments('DEM_CODIGO');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('DEM_COLETOR', 3);
            $table->string('DEM_ATIVIDADE', 30);
            $table->string('DEM_SITUACAO', 30);
            $table->string('DEM_PRESIDENTEDECAMPO', 10);
            $table->string('DEM_SUPERVISORCAMPO', 10);
            $table->char('DEM_ITINERANTE', 3);
            $table->string('DEM_CURSOTEOLOGICO', 20);
            $table->string('DEM_MESADIRETORA', 80);
            $table->string('DEM_NOMECONSELHO', 80);
            $table->string('DEM_FUNCAOCONSELHO', 80);
            $table->date('DEM_DTFILIACAO');
            $table->string('DEM_APRESENTADOPOR', 120);
            $table->date('DEM_DTRECEBIDO')->nullable();
            $table->string('DEM_IGREJADEORIGEM', 80);
            $table->string('DEM_CONVENCAODEORIGEM', 80);
            $table->char('DEM_REINTEGRADO', 3);
            $table->date('DEM_DTMUDANCA')->nullable();
            $table->date('DEM_DTMUDANCADEAREA')->nullable();
            $table->date('DEM_DTDESLIGAMENTO')->nullable();
            $table->string('DEM_MOTIVODESLIGAMENTO', 120);
            $table->date('DEM_DTBATISMOAGUA')->nullable();
            $table->date('DEM_DTBATISMOESPIRITO')->nullable();
            $table->date('DEM_DTCONSAGRACAO')->nullable();
            $table->date('DEM_DTORDENACAO')->nullable();
            $table->date('DEM_DTJUBILADO')->nullable();
            /* ALTERAR A PARTIR DAQUI */
            $table->date('DEM_DTAUXILIAR')->nullable();
            $table->date('DEM_DTDIACONO')->nullable();
            $table->date('DEM_DTPRESBITERO')->nullable();
            $table->date('DEM_DTEVANGELISTA')->nullable();
            $table->date('DEM_DTPASTOR')->nullable();
            $table->date('DEM_DTDIRIGENTE')->nullable();
            $table->date('DEM_DTCONVERSAO')->nullable();
            $table->date('DEM_DTCARTAMUDANCA')->nullable();
            $table->date('DEM_DTACLAMACAO')->nullable();
            $table->date('DEM_DTCONGREGADODESDE')->nullable();
            $table->char('DEM_NATIVO', 3);
            $table->string('DEM_DEPARTAMENTOIGREJA', 60);
            $table->date('DEM_DTDEPARTAMENTOIGREJA')->nullable();
            $table->string('DEM_FUNCAODEPARTAMENTOIGREJA', 60);
            /* ATÉ AQUI */
            $table->string('DEM_OBSERVACAO', '500');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('dados_eclesiaticos_ministros');
    }

}
