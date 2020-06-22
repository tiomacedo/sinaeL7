<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\DadosBancarios;
use Gate;

class DadosBancariosController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.dados-bancarios';
    protected $redirectIndex = '/restrito/dados-bancarios';
    protected $redirectCadastrar = '/restrito/dados-bancarios/cadastrar';
    protected $redirectEditar = '/restrito/dados-bancarios/editar';

    public function __construct(DadosBancarios $dadosBancarios, Request $request) {
        $this->model = $dadosBancarios;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE AREAS E IGREJAS';
    }

    public function bankMinistroCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        return view("{$this->nomeView}.cadastrar-editar")->with('id', $id)->with('tipo', $tipo);
    }

    public function bankMinistroCadastrarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $user = array('user_id' => $id);
        $dadosForm = array_merge($dadosForm, $user);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        if ($insert) {
            return redirect("restrito/ministros")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function bankMinistroEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        $data = $this->model->find($id);
        return view("{$this->nomeView}.cadastrar-editar", compact('data'))->with('tipo', $tipo);
    }

    public function bankMinistroEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $user_id = $this->model->find($id);
        $user = array('user_id' => $user_id->user_id);
        $dadosForm = array_merge($dadosForm, $user);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/ministros")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    /* dados bancários das missionárias */

    public function bankMissionariaCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        return view("{$this->nomeView}.cadastrar-editar")->with('id', $id)->with('tipo', $tipo);
    }

    public function bankMissionariaCadastrarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $user = array('user_id' => $id);
        $dadosForm = array_merge($dadosForm, $user);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        if ($insert) {
            return redirect("restrito/missionarias")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function bankMissionariaEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        $data = $this->model->find($id);
        return view("{$this->nomeView}.cadastrar-editar", compact('data'))->with('tipo', $tipo);
    }

    public function bankMissionariaEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $user_id = $this->model->find($id);
        $user = array('user_id' => $user_id->user_id);
        $dadosForm = array_merge($dadosForm, $user);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/missionarias")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

}
