<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejasTable extends Migration {

    public function up() {
        Schema::create('igrejas', function (Blueprint $table) {
            $table->increments('IGR_CODIGO');
            $table->integer('ARE_CODIGO')->unsigned();
            $table->foreign('ARE_CODIGO')->references('ARE_CODIGO')->on('areas')->onDelete('cascade');
            $table->string('IGR_MATRICULA', 10);
            $table->string('IGR_RESPONSAVEL', 120);
            $table->string('IGR_NOMECONGRECACAO', 60);
            $table->string('IGR_FONE', 14)->nullable();
            $table->string('IGR_CELULAR', 14)->nullable();
            $table->string('IGR_CNPJ', 18);
            $table->string('IGR_TEMPLO', 20);
            $table->integer('IGR_QTDMISSIONARIOS');
            $table->integer('IGR_QTDDIACONOS');
            $table->integer('IGR_QTDPRESBITEROS');
            $table->integer('IGR_QTDEVANGELISTAS');
            $table->integer('IGR_QTDPASTORES');
            $table->integer('IGR_QTDMEMBROS');
            $table->integer('IGR_QTDELEITORESCIDADE');
            $table->integer('IGR_QTDELEITORESIGREJA');
            $table->integer('IGR_QTDMEMBROSPOLITICOS');
            $table->integer('IGR_QTDFUNCIONARIOSPUBLICOS');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('igrejas');
    }

}
