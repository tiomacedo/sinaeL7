<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Http\Requests;
use App\Models\Permission;
use Gate;

class UserPermissionController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.user-permissao';
    protected $redirectIndex = '/restrito/permissao';
    protected $redirectCadastrar = '/restrito/permissao';
    protected $redirectEditar = '/restrito/permissao/editar';

    public function __construct(Permission $permission, Request $request) {
        $this->model = $permission;
        $this->request = $request;
        $this->gate = 'ADMIN';
    }
    
    
    public function roles($id)
    {
        $permission = $this->permission->find($id);
        $roles = $permission->roles()->get();
        return view('restrito.permissao.index', compact('permission', 'roles'));
    }
}