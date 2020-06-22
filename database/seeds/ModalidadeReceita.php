<?php

use Illuminate\Database\Seeder;

class ModalidadeReceita extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('tipos_receitas')->get()->count() == 0) {
            DB::table('tipos_receitas')->insert([
                [
                    'TR_CODIGO' => '1',
                    'TR_DESCRICAO' => 'MENSALIDADE DE OBREIRO',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'TR_CODIGO' => '2',
                    'TR_DESCRICAO' => 'DÍZIMO DE OBREIRO',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'TR_CODIGO' => '3',
                    'TR_DESCRICAO' => 'DÍZIMO DOS DÍZIMOS',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31m Tipos de Receitas não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
