<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserPerfilUsuarioController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.user-perfil-usuario';
    protected $redirectIndex = '/restrito/perfil-usuario';
    protected $redirectCadastrar = '/restrito/perfil-usuario/cadastrar';
    protected $redirectEditar = '/restrito/perfil-usuario/editar';

    public function __construct(User $user, Request $request) {
        $this->model = $user;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO FULL-USERS';
    }

    public function index() {
        $meuID = Auth::user()->id;
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        if ($meuID == 1) {
            $roles = DB::table('roles')->select('roles.*', 'roles.id as rolesId', 'roles.name as rolesName', 'roles.label as rolesLabel')
                    ->where('roles.name', '<>', 'SUPERADMIN')
                    ->get();
        } else {
            $roles = DB::table('roles')->select('roles.*', 'roles.id as rolesId', 'roles.name as rolesName', 'roles.label as rolesLabel')
                    ->where([['roles.name', '<>', 'SUPERADMIN'], ['roles.name', '<>', 'ADMIN']])
                    ->get();
        }

        $role_user = DB::table('role_user')
                ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
                ->select(
                        'role_user.id as idru', 'role_user.role_id as ruRoleId', 'role_user.user_id as ruUserId', 'roles.name as nameRole', 'roles.id as rolesId', 'roles.name as rolesName', 'roles.label as rolesLabel')
                ->get();
        $data = $this->model->where('id','<>',1)->get();
        return view("{$this->nomeView}.index", compact('data', 'roles', 'role_user'));
    }

    public function cadastrarPr($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
    }

    public function cadastrarPrDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $user_id = $id;
        $role_id = Input::get('role_id');
        $insert = DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [$user_id, $role_id]);

        if ($insert) {
            return '1';
        } else {
            return 'Falha ao Cadastrar, erro inesperado!';
        }
    }

    public function deletar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $deleta = DB::delete("delete from role_user where id = $id");
        if ($deleta) {
            return '1';
        } else {
            return 'Falha ao Deletar arquivo!';
        }
    }

}
