<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call('Cidades');
        $this->call('Areas');
        $this->call('Igrejas');
        $this->call('Institucional');
        $this->call('ModalidadeReceita');
        $this->call('Usuarios');
        $this->call('Roles');
        $this->call('Permissions');
        $this->call('PermissionsRoles');
        $this->call('RolesUsers');
    }

}
