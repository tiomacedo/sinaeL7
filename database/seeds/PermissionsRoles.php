<?php

use Illuminate\Database\Seeder;

class PermissionsRoles extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (DB::table('permission_role')->get()->count() == 0) {
            DB::table('permission_role')->insert([
                /* super admin */
                ['role_id' => 1, 'permission_id' => 1],
                /* admin */
                ['role_id' => 2, 'permission_id' => 2],
                ['role_id' => 2, 'permission_id' => 3],
                ['role_id' => 2, 'permission_id' => 4],
                ['role_id' => 2, 'permission_id' => 5],
                ['role_id' => 2, 'permission_id' => 6],
                ['role_id' => 2, 'permission_id' => 7],
                ['role_id' => 2, 'permission_id' => 8],
                ['role_id' => 2, 'permission_id' => 9],
                ['role_id' => 2, 'permission_id' => 10],
                ['role_id' => 2, 'permission_id' => 11],
                ['role_id' => 2, 'permission_id' => 12],
                ['role_id' => 2, 'permission_id' => 13],
                ['role_id' => 2, 'permission_id' => 14],
                ['role_id' => 2, 'permission_id' => 15],
                ['role_id' => 2, 'permission_id' => 16],
                 /* secretario */
                ['role_id' => 3, 'permission_id' => 3],
                ['role_id' => 3, 'permission_id' => 4],
                ['role_id' => 3, 'permission_id' => 5],
                ['role_id' => 3, 'permission_id' => 7],
                ['role_id' => 3, 'permission_id' => 8],
                ['role_id' => 3, 'permission_id' => 10],
                ['role_id' => 3, 'permission_id' => 11],
                ['role_id' => 3, 'permission_id' => 12],
                ['role_id' => 3, 'permission_id' => 14],
                ['role_id' => 3, 'permission_id' => 15],
                /* tesoureiro */
                ['role_id' => 4, 'permission_id' => 6],
                ['role_id' => 4, 'permission_id' => 10],
                ['role_id' => 4, 'permission_id' => 11],
                ['role_id' => 4, 'permission_id' => 12],
                ['role_id' => 4, 'permission_id' => 15],
                /* supervisor de área */
                ['role_id' => 5, 'permission_id' => 10],
                ['role_id' => 5, 'permission_id' => 11],
                ['role_id' => 5, 'permission_id' => 12],
                ['role_id' => 5, 'permission_id' => 13],
                ['role_id' => 5, 'permission_id' => 15],
                ['role_id' => 5, 'permission_id' => 17],
                /* usuario-ministro */
                ['role_id' => 6, 'permission_id' => 10],
                ['role_id' => 6, 'permission_id' => 11],
                ['role_id' => 6, 'permission_id' => 12],
                ['role_id' => 6, 'permission_id' => 13],
                ['role_id' => 6, 'permission_id' => 15],
                /* unifilhos e uemads */
                ['role_id' => 7, 'permission_id' => 11],
                ['role_id' => 7, 'permission_id' => 12],
                ['role_id' => 7, 'permission_id' => 13],
            ]);
        } else {
            echo "\e[31mPermission_Role não é uma tabela vazia. Não foi efetuado o Seed.";
        }
    }

}
