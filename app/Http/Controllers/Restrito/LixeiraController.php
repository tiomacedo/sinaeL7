<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\Areas;
use App\Models\Credenciais;
use App\Models\DadosBancarios;
use App\Models\DadosEclesiaticosMinistros;
use App\Models\DadosEclesiaticosMissionarias;
use App\Models\Dependentes;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use App\Models\Igrejas;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class LixeiraController extends StandardController {

    protected $model;
    protected $modelIgreja;
    protected $modelAreas;
    protected $modelEndereco;
    protected $modelEndUser;
    protected $modelBank;
    protected $modelDependente;
    protected $modelDEMin;
    protected $modelDEMis;
    protected $modelCredenciais;
    protected $request;
    protected $nomeView = 'restrito.lixeira';

    public function __construct(User $user, Areas $areas, Igrejas $igrejas, Endereco $enderecos, EnderecoUsuario $endUser, DadosBancarios $bank, Dependentes $dependentes, DadosEclesiaticosMinistros $demin, DadosEclesiaticosMissionarias $demis, Credenciais $credenciais, Request $request) {

        $this->model = $user;
        $this->modelIgreja = $igrejas;
        $this->modelAreas = $areas;
        $this->modelEndereco = $enderecos;
        $this->modelEndUser = $endUser;
        $this->modelBank = $bank;
        $this->modelDependente = $dependentes;
        $this->modelCredenciais = $credenciais;
        $this->modelDEMin = $demin;
        $this->modelDEMis = $demis;
        $this->request = $request;
        $this->gate = 'ITENS EXCLUIDOS';
    }

    public function usuarios() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->onlyTrashed()->get();
        return view("{$this->nomeView}.index", compact('data', 'igrejas', 'areas', 'roles'));
    }

    public function restaurarUsuario($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $restore = $this->model->onlyTrashed()->where('id', $id)->restore();
        if ($restore)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function deletarUsuario($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $item = $this->model->where([ ['id', '<>', '1'], ['id', $id]]);
        $deleta = $item->forceDelete();

        if ($deleta)
            return '1';
        else
            return 'Falha ao Deletar arquivo!';
    }

}
