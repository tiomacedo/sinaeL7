<?php

use Illuminate\Database\Seeder;
//USE App\Models\Igrejas;

class Igrejas extends Seeder {

//    public function run() {
//        factory('App\Models\Igrejas', 10)->create();
//    }

    public function run() {
        if (DB::table('igrejas')->get()->count() == 0) {
            DB::table('igrejas')->insert([
                [
                    'IGR_CODIGO' => 1,
                    'ARE_CODIGO' => 1,
                    'IGR_MATRICULA' => '00-0000',
                    'IGR_RESPONSAVEL' => 'NOME DO RESPONSÁVEL',
                    'IGR_FONE' => '(00)0000-0000',
                    'IGR_NOMECONGRECACAO' => 'DEL APÓS CRIAÇÃO DO ADM',
                    'IGR_CNPJ' => '00.000.000/0001-00',
                    'IGR_TEMPLO' => 'PRÓPRIO',
                    'IGR_QTDMISSIONARIOS' => 0,
                    'IGR_QTDDIACONOS' => 0,
                    'IGR_QTDPRESBITEROS' => 0,
                    'IGR_QTDEVANGELISTAS' => 0,
                    'IGR_QTDPASTORES' => 0,
                    'IGR_QTDMEMBROS' => 0,
                    'IGR_QTDELEITORESCIDADE' => 0,
                    'IGR_QTDELEITORESIGREJA' => 0,
                    'IGR_QTDMEMBROSPOLITICOS' => 0,
                    'IGR_QTDFUNCIONARIOSPUBLICOS' => 0,
                    /*                      */
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31mIgrejas não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }
}
