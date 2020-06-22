<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\Areas;
use App\Models\Credenciais;
use App\Models\DadosBancarios;
use App\Models\DadosEclesiaticosMinistros;
use App\Models\Dependentes;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use App\Models\Igrejas;
use App\Models\Cidades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use App\Mail\NovosMembros;

class MinistrosController extends StandardController
{

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
    protected $nomeView = 'restrito.ministros';
    protected $redirectIndex = '/restrito/ministros';
    protected $redirectCadastrar = '/restrito/ministros/cadastrar';
    protected $redirectEditar = '/restrito/ministros/editar';

    public function __construct(User $user, Areas $areas, Igrejas $igrejas, Endereco $enderecos, EnderecoUsuario $endUser, DadosBancarios $bank, Dependentes $dependentes, Cidades $cidades, DadosEclesiaticosMinistros $dem, Credenciais $credenciais, Request $request)
    {

        $this->model = $user; //
        $this->igrejas = $igrejas;
        $this->areas = $areas;
        $this->enderecos = $enderecos; //
        $this->cidades = $cidades;
        $this->enderecoUsuario = $endUser;
        $this->dadosBancarios = $bank;
        $this->dependentes = $dependentes;
        $this->credenciais = $credenciais;
        $this->dadosEclesiasticos = $dem;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO USUARIOS';
    }

    public function index()
    {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
            ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
            ->leftJoin('dados_bancarios', 'dados_bancarios.user_id', 'users.id')
            ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', 'users.id')
            ->leftJoin('enderecos', 'enderecos.END_CODIGO', 'enderecos_usuarios.END_CODIGO')
            ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
            ->where([['users.tp', 'MIN'], ['id', '<>', '1']])->get();
        $dependentes = $this->dependentes->all('DEP_CODIGO', 'user_id');
        $igrejas = $this->igrejas->get();
        return view("{$this->nomeView}.index", compact('data', 'igrejas', 'dependentes'));
    }

    public function cadastrar()
    {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $igrejas = $this->igrejas
            ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', 'igrejas.IGR_CODIGO')
            ->leftJoin('enderecos', 'enderecos.END_CODIGO', 'enderecos_igrejas.END_CODIGO')
            ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
            ->get();
        $cidades = $this->cidades->all();
        return view("{$this->nomeView}.cadastrar-editar", compact('igrejas', 'cidades'));
    }

    public function cadastrarDB()
    {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $dadosForm = $this->request->all();

        if (isset($dadosForm['password'])) {
            $pass = array('password' => bcrypt($dadosForm['password']));
        }

        if (!$dadosForm['dtviuvez'] == '' || $dadosForm['dtviuvez'] == '') {
            $dadosForm = Arr::except($dadosForm, ['dtviuvez']);
        }
        if (!$dadosForm['dtcasamento'] || $dadosForm['dtcasamento'] == '') {
            $dadosForm = Arr::except($dadosForm, ['dtcasamento']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);
        $dadosForm = array_merge($dadosForm, $pass);
        $email = array('email' => strtolower($dadosForm['email']));
        $dadosForm = array_merge($dadosForm, $email);
        $sexo = array('sexo' => 'M');
        $dadosForm = array_merge($dadosForm, $sexo);
        $tp = array('tp' => 'MIN');
        $dadosForm = array_merge($dadosForm, $tp);

        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect("/restrito/ministros/cadastrar")->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        $id = $insert->id;
        $insertLastUser = DB::table('role_user')->insert(['role_id' => 6, 'user_id' => $id]);
        $credencial = $this->credenciais->create(['CREDEN_STATUS' => 'INCOMPLETA', 'CREDEN_DTEMISSAO' => '1900-01-01', 'CREDEN_DTVALIDADE' => '1900-01-01', 'user_id' => $id]);

        if ($insert && $insertLastUser && $credencial) {
            $dados = array(
                'email' => "$insert->email",
                'name' => "$insert->name",
            );
            
            DB::commit();

            Mail::to($dados['email'])->send(new NovosMembros($dados));

            // Mail::send('restrito.wellcome.index', $dados, function ($message) use ($dados) {
            //     $message->to($dados['email'])->subject('Seja Bem Vindo!');
            // });

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

    public function editar($id)
    {
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

    public function editarDB($id)
    {
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

        if (!$dadosForm['dtviuvez'] == '' || $dadosForm['dtviuvez'] == '') {
            $dadosForm = Arr::except($dadosForm, ['dtviuvez']);
        }
        if (!$dadosForm['dtcasamento'] || $dadosForm['dtcasamento'] == '') {
            $dadosForm = Arr::except($dadosForm, ['dtcasamento']);
        }



        $dadosForm = array_map('strtoupper', $dadosForm);
        $dadosForm = array_merge($dadosForm, $pass);
        $email = array('email' => strtolower($dadosForm['email']));
        $dadosForm = array_merge($dadosForm, $email);
        $sexo = array('sexo' => 'M');
        $dadosForm = array_merge($dadosForm, $sexo);
        $tp = array('tp' => 'MIN');
        $dadosForm = array_merge($dadosForm, $tp);

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

    public function view($id)
    {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
            ->leftJoin('igrejas', 'igrejas.IGR_CODIGO', 'users.IGR_CODIGO')
            ->where([['id', $id], ['tp', 'MIN']])->get();
        $enderecos = $this->enderecos
            ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
            ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.END_CODIGO', 'enderecos.END_CODIGO')
            ->where('enderecos_usuarios.user_id', $id)->get();
        $dems = $this->dadosEclesiasticos->where('user_id', $id)->get();
        $idConjuge = $this->model->where('user_id', $id)->select('id')->first();
        if ($idConjuge == null || $idConjuge == '') {
            $dependentes = $this->dependentes->where('user_id', $id)->get();
        } else {
            $dependentes = $this->dependentes->where('user_id', $id)->orWhere('user_id', $idConjuge->id)->get();
        }
        return view("{$this->nomeView}.ficha", compact('data', 'enderecos', 'dependentes', 'dems'));
    }
}
