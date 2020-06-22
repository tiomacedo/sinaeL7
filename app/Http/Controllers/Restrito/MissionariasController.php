<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\Areas;
use App\Models\Credenciais;
use App\Models\DadosBancarios;
use App\Models\DadosEclesiaticosMissionarias;
use App\Models\Dependentes;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use App\Models\Igrejas;
use App\Models\Cidades;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MissionariasController extends StandardController {

    protected $model;
    protected $igrejas;
    protected $areas;
    protected $enderecos;
    protected $cidades;
    protected $enderecoUsuario;
    protected $dadosBancarios;
    protected $dependentes;
    protected $dadosEclesiasticos;
    protected $credenciais;
    protected $request;
    protected $nomeView = 'restrito.missionarias';
    protected $redirectIndex = '/restrito/missionarias';
    protected $redirectCadastrar = '/restrito/missionarias/cadastrar';
    protected $redirectEditar = '/restrito/missionarias/editar';

    public function __construct(User $user, Areas $areas, Igrejas $igrejas, Cidades $cidades, Endereco $enderecos, EnderecoUsuario $enderecoUsuario, DadosBancarios $dadosBancarios, Dependentes $dependentes, DadosEclesiaticosMissionarias $dem, Credenciais $credenciais, Request $request) {
        $this->model = $user;
        $this->igrejas = $igrejas;
        $this->areas = $areas;
        $this->cidades = $cidades;
        $this->enderecos = $enderecos;
        $this->enderecoUsuario = $enderecoUsuario;
        $this->dadosBancarios = $dadosBancarios;
        $this->dependentes = $dependentes;
        $this->credenciais = $credenciais;
        $this->dadosEclesiasticos = $dem;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO USUARIOS';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
                        ->leftJoin('dados_eclesiaticos_missionarias', 'dados_eclesiaticos_missionarias.user_id', 'users.id')
                        ->leftJoin('dados_bancarios', 'dados_bancarios.user_id', 'users.id')
                        ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', 'users.id')
                        ->leftJoin('enderecos', 'enderecos.END_CODIGO', 'enderecos_usuarios.END_CODIGO')
                        ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
                        ->where('users.tp', 'MIS')->get();
        $igrejas = $this->igrejas->get();
        $dependentes = $this->dependentes->all('DEP_CODIGO', 'user_id');
        return view("{$this->nomeView}.index", compact('data', 'dependentes'));
    }

    public function cadastrar() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $missionaria = $this->model->where('tp', 'MIN')
                ->where([['id', '<>', '1'], ['conjuge', '<>', '']])
                ->select('name', 'conjuge', 'id')
                ->get();

        $igrejas = $this->igrejas
                ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', 'igrejas.IGR_CODIGO')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', 'enderecos_igrejas.END_CODIGO')
                ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
                ->get();
        $cidades = $this->cidades->all();
        return view("{$this->nomeView}.cadastrar-editar", compact('igrejas', 'cidades', 'missionaria'));
    }

    public function cadastrarDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $dadosForm = $this->request->all();


        $user_id = $dadosForm['user_id'];
        /* DADOS RLACIONADOS A TABELA DO MINISTRO */
        $dadoDBMinistro = $this->model->where('id', $user_id)->select('name', 'conjuge', 'id', 'dtcasamento', 'matricula')->first();


        $idMinistro = array('user_id' => $user_id); /* insere o ID do ministro */
        $dadosForm = array_merge($dadosForm, $idMinistro);
        $name = array('name' => $dadoDBMinistro->conjuge); /* insere o nome da missionaria */
        $dadosForm = array_merge($dadosForm, $name);
        $nomeMinistro = array('conjuge' => $dadoDBMinistro->name); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $nomeMinistro);
        //$casamento = array('dtcasamento' => $dadoDBMinistro->dtcasamento); /* insere o nome do ministro */
        //$dadosForm = array_merge($dadosForm, $casamento);
        $matricula = array('matricula' => $dadoDBMinistro->matricula); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $matricula);
        $tp = array('tp' => 'MIS'); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $tp);
        $sexo = array('sexo' => 'F'); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $sexo);

        //dd($dadosForm);


        if (isset($dadosForm['dtviuvez']) && $dadosForm['dtviuvez'] == '') {
            unset($dadosForm['dtviuvez']);
        }

        if (isset($dadosForm['password'])) {
            $pass = array('password' => bcrypt($dadosForm['password']));
        }

        $dadosForm = array_map('strtoupper', $dadosForm);
        $email = array('email' => strtolower($dadosForm['email']));
        $dadosForm = array_merge($dadosForm, $email);
        $dadosForm = array_merge($dadosForm, $pass);



        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect("/restrito/missionarias/cadastrar")->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
            $update = $this->model->where('id', $insert->user_id)->update(['confirmacao_casal' => 'CONFIRMADO']);
        }

        $id = $insert->id;
        $insertLastUser = DB::table('role_user')->insert(['role_id' => 7, 'user_id' => $id]);
        $credencial = $this->credenciais->create(['CREDEN_STATUS' => 'INCOMPLETA', 'CREDEN_DTEMISSAO' => '1900-01-01', 'CREDEN_DTVALIDADE' => '1900-01-01', 'user_id' => $id]);

        if ($insert && $insertLastUser && $credencial) {
            DB::commit();
            $dados = array(
                'email' => "$insert->email",
                'name' => "$insert->name",
            );

            Mail::send('restrito.wellcome.index', $dados, function( $message ) use ($dados) {
                $message->to($dados['email'])->subject('Seja Bem Vindo!');
            });

            return redirect("$this->redirectIndex")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        } else {
            DB::rollBack();
            return redirect("$this->redirectIndex")
                            ->with('status', 'error')
                            ->with('titulo', 'Erro!')
                            ->with('mensagem', 'Houve um erro na inserção dos dados. Tente novamente.');
        }
    }

    public function editar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model->find($id);
        $igrejas = $this->igrejas
                ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', 'igrejas.IGR_CODIGO')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', 'enderecos_igrejas.END_CODIGO')
                ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
                ->get();
        $cidades = $this->cidades->all();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'igrejas', 'cidades'));
    }

    public function editarDB($id) {
        $passUser = $this->model->where([['id', $id], ['id', '<>', '1']])->first();

        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();

        if (isset($dadosForm['password']) && $dadosForm['password'] != '') {
            $pass = array('password' => bcrypt($dadosForm['password']));
        } else {
            $pass = array('password' => $passUser->password);
        }

        $dadosForm = $this->request->all();
        $dadoMissionariaBloqueados = $this->model->where('id', $id)->select('name', 'conjuge', 'user_id', 'dtcasamento', 'matricula')->first();
        $user_id = $dadoMissionariaBloqueados->user_id;
        $idMinistro = array('user_id' => $user_id); /* insere o ID do ministro */
        $dadosForm = array_merge($dadosForm, $idMinistro);
        $nomeMissionaria = array('name' => $dadoMissionariaBloqueados->name); /* insere o nome da missionaria */
        $dadosForm = array_merge($dadosForm, $nomeMissionaria);
        $nomeMinistro = array('conjuge' => $dadoMissionariaBloqueados->conjuge); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $nomeMinistro);
        // $casamento = array('dtcasamento' => $dadoMissionariaBloqueados->dtcasamento); /* insere o nome do ministro */
        // $dadosForm = array_merge($dadosForm, $casamento);
        $matricula = array('matricula' => $dadoMissionariaBloqueados->matricula); /* insere a matricula da missionária */
        $dadosForm = array_merge($dadosForm, $matricula);
        $tp = array('tp' => 'MIS'); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $tp);
        $sexo = array('sexo' => 'F'); /* insere o nome do ministro */
        $dadosForm = array_merge($dadosForm, $sexo);

        if (isset($dadosForm['dtviuvez']) && $dadosForm['dtviuvez'] == '') {
            unset($dadosForm['dtviuvez']);
        }

        if (isset($dadosForm['password'])) {
            $pass = array('password' => bcrypt($dadosForm['password']));
        }

        $dadosForm = array_map('strtoupper', $dadosForm);
        $email = array('email' => strtolower($dadosForm['email']));
        $dadosForm = array_merge($dadosForm, $email);
        $dadosForm = array_merge($dadosForm, $pass);

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("$this->redirectIndex")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    public function view($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
                        ->leftJoin('igrejas', 'igrejas.IGR_CODIGO', 'users.IGR_CODIGO')
                        ->where([['id', $id], ['tp', 'MIS']])->get();
        $enderecos = $this->enderecos
                        ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
                        ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.END_CODIGO', 'enderecos.END_CODIGO')
                        ->where('enderecos_usuarios.user_id', $id)->get();
        $dems = $this->dadosEclesiasticos->where('user_id', $id)->get();
        $idConjuge = $this->model->where('id', $id)->select('user_id')->first();
        $dependentes = $this->dependentes->where('user_id', $id)->orWhere('user_id', $idConjuge->user_id)->get();

        return view("{$this->nomeView}.ficha", compact('data', 'enderecos', 'dependentes', 'dems'));
    }

}
