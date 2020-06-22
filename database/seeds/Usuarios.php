<?php

use Illuminate\Database\Seeder;

class Usuarios extends Seeder {

    public function run() {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'id' => 1,
                    'IGR_CODIGO' => 1,
                    'CID_CODIGO' => 1721000,
                    'user_id' => null,
                    'matricula' => '000000',
                    'name' => 'IMPLANTADOR BEMFUNCIONAL',
                    'foto' => '',
                    'dtnascimento' => '1983-09-18',
                    'cpf' => '000.000.000-00',
                    'rg' => '000.000 SSP-TO',
                    'pai' => 'GERVA TAVARES MACEDO',
                    'mae' => 'PULCINA CORTE DA COSTA MACEDO',
                    'estadocivil' => 'CASADO',
                    'conjuge' => 'LEYDIANE DA SILVA ELIAS MACEDO',
                    'dtcasamento' => '2003-05-16',
                    'dtviuvez' => null,
                    'nacionalidade' => 'BRASILEIRA',
                    'escolaridade' => 'SUPERIOR COMPLETO',
                    'phone' => '(63)98406-2025',
                    'cellphone' => '(63)98406-2025',
                    'tp' => 'MIN',
                    'email' => 'super-admin@bemfuncional.com',
                    'password' => '$2y$10$7CCQLfry74KV6QDzP57OWuDPhJFfhKCQfKlNCRIqFD/EKNTg0dWdm',
                    'tx_mensal' => 'SIM',
                    'tx_obreiro' => 'NÃO',
                    'tx_dizimo' => 'NÃO',
                    'sexo' => 'M',
                    'titulo_eleitoral' => '0000-0000-0000',
                    'profissao' => 'ANALISTA DE SISTEMAS',
                    /*                 */
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        } else {
            echo "\e[31m Users não é uma tabela vazia. Não foi efetuado o Seed.";
        }

        //factory('App\Models\User', 10)->create();
    }

}
