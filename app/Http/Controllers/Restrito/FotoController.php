<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class FotoController extends StandardController {

    protected $model;
    protected $request;
    protected $nomeView = 'restrito.user-pessoa';

    public function __construct(User $user, Request $request) {
        $this->model = $user;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO USUARIOS';
    }

    public function foto($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            return redirect()->back()
                            ->with('status', 'error')
                            ->with('titulo', 'Usuário inabilitado!')
                            ->with('mensagem', 'Seu perfil de usuário não tem permissão para alterar imagens!');
        }
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function fotoDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            return redirect()->back()
                            ->with('status', 'error')
                            ->with('titulo', 'Usuário inabilitado!')
                            ->with('mensagem', 'Seu perfil de usuário não tem permissão para alterar imagens!');
        }
        
        $dadosForm = $this->request->all();
        $id = $dadosForm['id'];
        $foto = $this->request->file('foto');

        if (isset($foto) && $foto->isValid()) {
            //return View::make('jcrop')->with('image', 'images/'. Session::get('image')
            $rules = ['foto' => 'image|mimes:jpg,jpeg,png,bmp,gif|max:1024'];
            $validator = validator($dadosForm, $rules);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return $messages;
            }
            $nomeArquivo = "USER_$id";
            //$extensao = $foto->getClientOriginalExtension();
            $path = public_path('assets/users/');
            //$path = storage_path('app/public/users');

            $upload = Image::make($foto)->fit('200', '260')->encode('jpg', 100)->save($path . "$nomeArquivo.jpg");
            //$imagem = DB::table('users')->where('id', $id)->first(); 

            if ($upload) {
                $item = $this->model->find($id);
                $insert = $item->update(['foto' => "$upload->basename"]);
            }
            if ($insert) {
                return redirect()->back()
                                ->with('status', 'success')
                                ->with('titulo', 'Arquivo Alterado!')
                                ->with('mensagem', 'O registro foi salvo com sucesso!');
            }
        } else {
            return redirect()->back()
                            ->with('status', 'error')
                            ->with('titulo', 'Formato inválido!')
                            ->with('mensagem', 'O formato de imagem é inválido!
                                    Selecione outra imagem no formato (.jpg .gif .bmp .png');
        }
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $roles = DB::table('role_user')
                        ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                        ->select('role_user.id as idru', 'role_user.role_id as ruRoleId', 'role_user.user_id as ruUserId', 'roles.name as nameRole', 'roles.id as rolesId', 'roles.name as rolesName', 'roles.label as rolesLabel')->get();


        $data = $this->model
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->leftJoin('dados_bancarios', 'dados_bancarios.user_id', '=', 'users.id')
                ->leftJoin('dependentes', 'dependentes.user_id', '=', 'users.id')
                ->get();


        $igrejas = $this->modelIgreja->all();
        $areas = $this->modelAreas->all();
        return view("{$this->nomeView}.index", compact('data', 'igrejas', 'areas', 'roles'));
    }

    public function cadastrar() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $igrejas = $this->modelIgreja
                        ->leftJoin('orgaos', 'igrejas.ORG_CODIGO', '=', 'orgaos.ORG_CODIGO')
                        ->select('igrejas.DEP_CODIGO as DEPCODIGO', 'igrejas.ORG_CODIGO as DEPORGCODIGO', 'igrejas.DEP_NOME as DEPNOME', 'orgaos.ORG_SIGLA as ORGSIGLA')->get();
        return view("{$this->nomeView}.index", compact('igrejas'));
    }

    public function cadastrarDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $dadosForm = $this->request->all();

        if (isset($dadosForm['password'])) {
            $pass = array('password' => bcrypt($dadosForm['password']));
        }

        if (isset($dadosForm['tx_dizimo1'])) {
            $txd = array('tx_dizimo' => $dadosForm['tx_dizimo1']);
            $dadosForm = array_merge($dadosForm, $txd);
            unset($dadosForm['tx_dizimo1']);
        }

        if (isset($dadosForm['tx_obreiro1'])) {
            $txo = array('tx_obreiro' => $dadosForm['tx_obreiro1']);
            $dadosForm = array_merge($dadosForm, $txo);
            unset($dadosForm['tx_obreiro1']);
        }

        if (isset($dadosForm['tx_mensal1'])) {
            $txm = array('tx_mensal' => $dadosForm['tx_mensal1']);
            $dadosForm = array_merge($dadosForm, $txm);
            unset($dadosForm['tx_mensal1']);
        }

        if (isset($dadosForm['dtviuvez']) && $dadosForm['dtviuvez'] == '') {
            unset($dadosForm['dtviuvez']);
        }
        if (isset($dadosForm['dtcasamento']) && $dadosForm['dtcasamento'] == '') {
            unset($dadosForm['dtcasamento']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);
        $dadosForm = array_merge($dadosForm, $pass);
        $email = array('email' => strtolower($dadosForm['email']));
        $dadosForm = array_merge($dadosForm, $email);

        $validator = validator($dadosForm, $this->model->rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }
        $insert = $this->model->create($dadosForm);



        if ($insert)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function editar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function editarDB($id) {
        $tbl = $this->model->where('id', $id)->first();

        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);

        $dadosForm = $this->request->all();


        if (isset($dadosForm['password']) && $dadosForm['password'] != '') {
            $pass = array('password' => bcrypt($dadosForm['password']));
        } else {
            $pass = array('password' => $tbl->password);
        }

        if (isset($dadosForm['tx_dizimo1'])) {
            $txd = array('tx_dizimo' => $dadosForm['tx_dizimo1']);
            $dadosForm = array_merge($dadosForm, $txd);
            unset($dadosForm['tx_dizimo1']);
        }

        if (isset($dadosForm['tx_obreiro1'])) {
            $txo = array('tx_obreiro' => $dadosForm['tx_obreiro1']);
            $dadosForm = array_merge($dadosForm, $txo);
            unset($dadosForm['tx_obreiro1']);
        }

        if (isset($dadosForm['tx_mensal1'])) {
            $txm = array('tx_mensal' => $dadosForm['tx_mensal1']);
            $dadosForm = array_merge($dadosForm, $txm);
            unset($dadosForm['tx_mensal1']);
        }

        if (isset($dadosForm['dtviuvez']) && $dadosForm['dtviuvez'] == '') {
            unset($dadosForm['dtviuvez']);
        }
        if (isset($dadosForm['dtcasamento']) && $dadosForm['dtcasamento'] == '') {
            unset($dadosForm['dtcasamento']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);
        $dadosForm = array_merge($dadosForm, $pass);
        $email = array('email' => strtolower($dadosForm['email']));
        $dadosForm = array_merge($dadosForm, $email);


        $validator = validator($dadosForm, $rulesTratada);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->model->find($id);
        $update = $item->update($dadosForm);

        if ($update)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function view($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $views = $this->model
                ->leftJoin('igrejas', 'igrejas.IGR_CODIGO', '=', 'users.IGR_CODIGO')
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->leftJoin('dados_bancarios', 'dados_bancarios.user_id', '=', 'users.id')
                ->leftJoin('dependentes', 'dependentes.user_id', '=', 'users.id')
                ->find($id);
        return response()->json($views);
    }

    public function endereco($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function enderecoDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $dadosForm = $this->request->all();
        $validator = validator($dadosForm, $this->modelEndereco->rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }
        $insert = $this->modelEndereco->create($dadosForm);

        if ($insert) {
            $endereco = $this->modelEndereco->orderBy('END_CODIGO', 'desc')->first();
            $endereco = $endereco->END_CODIGO;
            $dados = array('END_CODIGO' => $endereco, 'user_id' => $id);
            $validatorEI = validator($dados, $this->modelEndUser->rules);
            if ($validatorEI->fails()) {
                $messages = $validatorEI->messages();
                return $messages;
            }
            $insertEI = $this->modelEndUser->create($dados);
        }

        $data = $this->model
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                //->select('areas.*', 'igrejas.*', 'igrejas.IGR_CODIGO as IGRCODIGO', 'enderecos_usuarios.*', 'enderecos.*')
                ->get();
        $areasIgreja = $this->modelEndereco->all();




        if ($insert && $insertEI) {
            DB::commit();
            return redirect()->action('Restrito\MinistrosController@index');
        } else {
            DB::rollBack();
            return view("{$this->nomeView}.index", compact('data', 'areasIgreja'));
        }
    }

    public function editarEndereco($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->modelEndereco->find($id);
        return response()->json($data);
    }

    public function editarEnderecoDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->modelEndereco->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $validator = validator($dadosForm, $rulesTratada);


        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->modelEndereco->find($id);
        $update = $item->update($dadosForm);

        if ($update)
            return redirect()->action('Restrito\MinistrosController@index');
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function dependente($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function dependenteDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $dadosForm = $this->request->all();
        $id = array('user_id' => $id);
        unset($dadosForm['user_id']);
        $dadosForm = array_merge($dadosForm, $id);
        $validator = validator($dadosForm, $this->modelDependente->rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }
        $insert = $this->modelDependente->create($dadosForm);

        if ($insert) {
            DB::commit();
            return redirect()->action('Restrito\MinistrosController@index');
        } else {
            DB::rollBack();
            return redirect()->action('Restrito\MinistrosController@index');
        }
    }

    public function editarDependente($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->modelDependente->find($id);
        return response()->json($data);
    }

    public function editarDependenteDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->modelDependente->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $validator = validator($dadosForm, $rulesTratada);


        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->modelDependente->find($id);
        $update = $item->update($dadosForm);

        if ($update)
            return redirect()->action('Restrito\MinistrosController@index');
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function bank($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function bankDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $dadosForm = $this->request->all();
        $id = array('user_id' => $id);
        unset($dadosForm['user_id']);
        $dadosForm = array_merge($dadosForm, $id);
        $validator = validator($dadosForm, $this->modelBank->rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }
        $insert = $this->modelBank->create($dadosForm);

        if ($insert) {
            DB::commit();
            return redirect()->action('Restrito\MinistrosController@index');
        } else {
            DB::rollBack();
            return redirect()->action('Restrito\MinistrosController@index');
        }
    }

    public function editarBank($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->modelBank->find($id);
        return response()->json($data);
    }

    public function editarBankDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->modelBank->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $validator = validator($dadosForm, $rulesTratada);


        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->modelBank->find($id);
        $update = $item->update($dadosForm);

        if ($update)
            return redirect()->action('Restrito\MinistrosController@index');
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function dadosEclesiasticos($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function dadosEclesiasticosDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $dadosForm = $this->request->all();

        $id = array('user_id' => $id);
        unset($dadosForm['user_id']);
        $dadosForm = array_merge($dadosForm, $id);

        $validator = validator($dadosForm, $this->modelDEM->rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }
        $insert = $this->modelDEM->create($dadosForm);

        if ($insert) {
            DB::commit();
            return redirect()->action('Restrito\MinistrosController@index');
        } else {
            DB::rollBack();
            return redirect()->action('Restrito\MinistrosController@index');
        }
    }

    public function editarDadosEclesiasticos($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->modelDEM->find($id);
        return response()->json($data);
    }

    public function editarDadosEclesiasticosDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->modelDEM->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $validator = validator($dadosForm, $rulesTratada);


        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->modelDEM->find($id);
        $update = $item->update($dadosForm);

        if ($update)
            return redirect()->action('Restrito\MinistrosController@index');
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

}
