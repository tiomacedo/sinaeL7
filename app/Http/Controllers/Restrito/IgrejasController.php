<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Igrejas;
use App\Models\Areas;
use App\Models\Endereco;
use App\Models\EnderecoIgreja;
use App\Models\Cidades;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class IgrejasController extends StandardController {

    protected $model;
    protected $areas;
    protected $cidades;
    protected $enderecos;
    protected $enderecosIgrejas;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.igrejas';
    protected $redirectIndex = '/restrito/igrejas';
    protected $redirectCadastrar = '/restrito/igrejas/cadastrar';
    protected $redirectEditar = '/restrito/igrejas/editar';

    public function __construct(Igrejas $igrejas, Areas $areas, Endereco $enderecos, EnderecoIgreja $enderecoIgreja, Cidades $cidades, Request $request) {
        $this->model = $igrejas;
        $this->areas = $areas;
        $this->cidades = $cidades;
        $this->enderecos = $enderecos;
        $this->modelEndIgreja = $enderecoIgreja;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE AREAS E IGREJAS';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
                ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', 'igrejas.IGR_CODIGO')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', 'enderecos_igrejas.END_CODIGO')
                ->leftJoin('cidades', 'cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
                ->leftJoin('areas', 'igrejas.ARE_CODIGO', 'areas.ARE_CODIGO')
                ->select('areas.*', 'igrejas.*', 'cidades.*', 'igrejas.IGR_CODIGO as IGRCODIGO', 'enderecos_igrejas.*', 'enderecos.*')
                ->get();
        //dd($data);
        return view("{$this->nomeView}.index", compact('data'));
    }

    public function cadastrar() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $areas = $this->areas->all();
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('areas', 'cidades'));
    }

    public function editar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model->find($id);
        $areas = $this->areas->all();
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'areas', 'cidades'));
    }

    public function view($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $views = $this->model
                ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', '=', 'igrejas.IGR_CODIGO')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_igrejas.END_CODIGO')
                ->leftJoin('areas', 'igrejas.ARE_CODIGO', '=', 'areas.ARE_CODIGO')
                ->select('areas.*', 'igrejas.*', 'igrejas.IGR_CODIGO as IGRCODIGO', 'enderecos_igrejas.*', 'enderecos.*')
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
        $validator = validator($dadosForm, $this->enderecos->rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }
        $insert = $this->enderecos->create($dadosForm);

        if ($insert) {
            $endereco = DB::table('enderecos')->orderBy('END_CODIGO', 'desc')->first();
            $endereco = $endereco->END_CODIGO;
            $dados = array('END_CODIGO' => $endereco, 'IGR_CODIGO' => $id);
            $validatorEI = validator($dados, $this->modelEndIgreja->rules);
            if ($validatorEI->fails()) {
                $messages = $validatorEI->messages();
                return $messages;
            }
            $insertEI = $this->modelEndIgreja->create($dados);
        }

        $data = $this->model
                ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', '=', 'igrejas.IGR_CODIGO')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_igrejas.END_CODIGO')
                ->leftJoin('areas', 'igrejas.ARE_CODIGO', '=', 'areas.ARE_CODIGO')
                ->select('areas.*', 'igrejas.*', 'igrejas.IGR_CODIGO as IGRCODIGO', 'enderecos_igrejas.*', 'enderecos.*')
                ->get();
        $areas = $this->areas->all();



        if ($insert && $insertEI) {
            DB::commit();
            return redirect()->action('Restrito\IgrejasController@index');
        } else {
            DB::rollBack();
            return view("{$this->nomeView}.index", compact('data', 'areas'));
        }
    }

    public function editarEndereco($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->enderecos->find($id);
        return response()->json($data);
    }

    public function editarEnderecoDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->enderecos->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $validator = validator($dadosForm, $rulesTratada);


        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->enderecos->find($id);
        $update = $item->update($dadosForm);

        if ($update)
            return redirect()->action('Restrito\IgrejasController@index');
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

}
