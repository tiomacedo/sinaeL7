<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DadosInstitucionais extends Migration {

    public function up() {
        Schema::create('dados_institucionais', function (Blueprint $table) {
            $table->increments('DI_CODIGO');
            $table->string('DI_NOMEFANTASIA', 200);
            $table->string('DI_RAZAOSOCIAL', 200);
            $table->string('DI_INSCRICAOMUNICIPAL', 20)->nullable();
            $table->string('DI_INSCRICAOESTADUAL', 20)->nullable();
            $table->string('DI_CNPJ', 20);
            $table->string('DI_ENDERECO', 200);
            $table->string('DI_CIDADE', 120);
            $table->string('DI_UF', 2);
            $table->string('DI_CEP', 15);
            $table->string('DI_FONE', 15);
            $table->string('DI_LOGO', 50)->nullable();
            $table->string('DI_AGENCIA', 10);
            $table->char('DI_AGENCIA_DV', 1)->nullable();
            $table->string('DI_CONTA', 10);
            $table->char('DI_CONTA_DV', 1);
            $table->float('DI_MENSALIDADE', 10, 2);
            $table->float('DI_MULTA', 10, 2)->nullable();
            $table->float('DI_JUROS', 10, 2)->nullable();
            $table->float('DI_JUROSAPOS', 10, 2)->nullable();
            $table->integer('DI_DIASPROTESTO')->nullable();
            $table->string('DI_CARTEIRA', 20)->nullable();
            $table->string('DI_VARIACAOCARTEIRA', 20)->nullable();
            $table->string('DI_CONVENIO', 20);
            $table->string('DI_RANGE', 20)->nullable();
            $table->string('DI_CODIGOCLIENTE', 20);
            $table->string('DI_MENSAGEM1', 200);
            $table->string('DI_MENSAGEM2', 200)->nullable();
            $table->string('DI_MENSAGEM3', 200)->nullable();
            $table->string('DI_INSTRUCAO1', 200);
            $table->string('DI_INSTRUCAO2', 200)->nullable();
            $table->string('DI_INSTRUCAO3', 200)->nullable();
            $table->string('DI_INSTRUCAO4', 200)->nullable();
            $table->string('DI_INSTRUCAO5', 200)->nullable();
            $table->string('DI_ACEITE', 20);
            $table->string('DI_ESPECIEDOC', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('dados_eclesiaticos_missionarias');
    }

}
