<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Debitos;
use App\Models\DebitosTipo;
use Illuminate\Support\Facades\Gate;

class DebitosController extends StandardController {

    protected $model;
    protected $debitosTipo;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.debitos';
    protected $redirectIndex = '/restrito/debitos';
    protected $redirectCadastrar = '/restrito/debitos/cadastrar';
    protected $redirectEditar = '/restrito/debitos/editar';

    public function __construct(Debitos $debitos, DebitosTipo $tipo, Request $request) {
        $this->model = $debitos;
        $this->debitosTipo = $tipo;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO CONTABIL';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
                ->leftJoin('tipos_debitos','tipos_debitos.TD_CODIGO','debitos.TD_CODIGO' )
                ->get();
        return view("{$this->nomeView}.index", compact('data'));
    }

    public function cadastrar() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipos = $this->debitosTipo->all();
        return view("{$this->nomeView}.cadastrar-editar", compact('tipos'));
    }

    public function cadastrarDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        if (isset($dadosForm['DEB_DTPAGAMENTO']) && $dadosForm['DEB_DTPAGAMENTO'] == '') {
            unset($dadosForm['DEB_DTPAGAMENTO']);
        }

        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        if ($insert) {
            return redirect("$this->redirectIndex")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function editar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model->find($id);
        $tipos = $this->debitosTipo->all();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'tipos'));
    }

    public function editarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        if (isset($dadosForm['DEB_DTPAGAMENTO']) && $dadosForm['DEB_DTPAGAMENTO'] == '') {
            unset($dadosForm['DEB_DTPAGAMENTO']);
        }

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

}
