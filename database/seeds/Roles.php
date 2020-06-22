<?php

use Illuminate\Database\Seeder;

class Roles extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('roles')->get()->count() == 0) {
            DB::table('roles')->insert([
                
                [
                    'id' => 1,
                    'name' => 'SUPERADMIN',
                    'label' => 'Perfil com acesso a todos os controles do sistema.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'ADMIN',
                    'label' => 'Perfil com acesso a todos os controles do sistema, exceto a criação de um novo usuário Admin',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'SECRETARIO',
                    'label' => 'Perfil das prinicipais ações da Secretaria da CIMADSETA',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'TESOUREIRO',
                    'label' => 'Perfil das prinicipais ações da contabilidade da CIMADSETA',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'SUPERVISOR-CAMPO',
                    'label' => 'Perfil de supervisor de campo para visualizar usuários e igrejas do campo do qual é supervisor, além alterar seus dados parcialmente',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'USUARIO-MINISTRO',
                    'label' => 'Perfil para usuários (ministros) com acesso a transparência, minhas finanças, solicitações e minha credencial.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'USUARIO-SIMPLES',
                    'label' => 'Perfil para usuários (missionárias e unifilhos) com acesso a solicitações e minha credencial.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                
            ]);
        } else {
            echo "\e[31mRoles não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
