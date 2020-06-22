<?php

use Illuminate\Database\Seeder;

class Areas extends Seeder {

    public function run() {
        if (DB::table('areas')->get()->count() == 0) {
            DB::table('areas')->insert([
                [
                    'ARE_CODIGO' => '1',
                    'ARE_CODIGOMANUAL' => '00-00',
                    'ARE_DESCRICAO' => 'ÁREA TESTE (DELETE SOMENTE APÓS A CRIAÇÃO DE NOVAS ÁREAS, IGREJAS E USUÁRIOS)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31mAreas não é uma tabela vazia. Não foi efetuado o Seed.";
        }
        //factory('App\Models\Areas', 10)->create();
    }

}
