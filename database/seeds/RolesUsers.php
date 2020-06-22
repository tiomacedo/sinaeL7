<?php

use Illuminate\Database\Seeder;

class RolesUsers extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('role_user')->get()->count() == 0) {
            DB::table('role_user')->insert([
                [
                    /* role_id 1 é o superAdmin */
                    'role_id' => 1,
                    'user_id' => 1,
                ],
                
                
            ]);
        } else {
            echo "\e[31mRole_User não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
