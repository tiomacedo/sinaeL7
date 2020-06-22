<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Role;
use App\Models\Permission;
use Gate;

class UserRoleController extends StandardController {

    protected $model;
    protected $modelPermission;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.user-perfil';
    protected $redirectIndex = '/restrito/perfil';
    protected $redirectCadastrar = '/restrito/perfil/cadastrar';
    protected $redirectEditar = '/restrito/perfil/editar';

    public function __construct(Role $role, Permission $permission, Request $request) {
        $this->modelPermission = $permission;
        $this->model = $role;
        $this->request = $request;
        $this->gate = 'ADMIN';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model->all();
        $permissions = $this->modelPermission->all();
        return view("{$this->nomeView}.index", compact('data', 'permissions'));
    }

}
