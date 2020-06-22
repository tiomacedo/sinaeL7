<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Http\Requests;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserPermissaoPerfilController extends StandardController {

    protected $model;
    protected $modelPermission;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.user-permissao-perfil';
    protected $redirectIndex = '/restrito/permissao-perfil';
    protected $redirectCadastrar = '/restrito/permissao-perfil/cadastrar';
    protected $redirectEditar = '/restrito/permissao-perfil/editar';

    public function __construct(Role $role, Permission $permission, Request $request) {
        $this->modelPermission = $permission;
        $this->model = $role;
        $this->request = $request;
        $this->gate = 'ADMIN';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $permissions = $this->modelPermission
                ->select('permissions.id as permissionsId', 'permissions.name as permissionsName', 'permissions.label as permissionsLabel')
                ->get();


        $permission_role = DB::table('permission_role')
                ->leftJoin('roles', 'permission_role.role_id', '=', 'roles.id')
                ->leftJoin('permissions', 'permission_role.permission_id', '=', 'permissions.id')
                ->select(
                        'permission_role.id as idpr', 'permission_role.role_id as prRoleId', 'permission_role.permission_id as prPermId', 'permissions.name as namePerm', 'roles.id as rolesId', 'roles.name as rolesName', 'roles.label as rolesLabel')
                ->get();

//        dd($permission_role);





        $data = $this->model->all();
        return view("{$this->nomeView}.index", compact('data', 'permissions', 'permission_role'));
    }

    public function cadastrarPR($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
    }

    public function cadastrarPrDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $permission_id = Input::get('permission_id');
        $role_id = $id;
        $insert = DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [$permission_id, $role_id]);

        if ($insert)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function deletar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $deleta = DB::delete("delete from permission_role where id = $id");
        if ($deleta)
            return '1';
        else
            return 'Falha ao Deletar arquivo!';
    }

}
