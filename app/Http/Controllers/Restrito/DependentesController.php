<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Dependentes;
use App\Models\User;
use Gate;

class DependentesController extends StandardController {

    protected $model;
    protected $users;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.dependentes';
    protected $redirectIndex = '/restrito/dependentes';
    protected $redirectCadastrar = '/restrito/dependentes/cadastrar';
    protected $redirectEditar = '/restrito/dependentes/editar';

    public function __construct(Dependentes $dependentes, User $user, Request $request) {
        $this->model = $dependentes;
        $this->users = $user;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE AREAS E IGREJAS';
    }

    public function dependentesMinistro($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $idConjuge = $this->users->where('user_id', $id)->select('id')->first();

        if ($idConjuge == null) {
            $data = $this->model->where('user_id', $id)->get();
        } else {
            $data = $this->model->where('user_id', $id)->orWhere('user_id', $idConjuge->id)->get();
        }
        $user = $this->users->find($id);
        $nome = $user->name;
        $conjuge = $user->conjuge;
        $tipo = 'ministros';

        if (!isset($conjuge) || $conjuge == '' || $conjuge == null) {
            return view("{$this->nomeView}.index", compact('data'))->with('tipo', $tipo)
                            ->with('id', $id)->with('nome', $nome);
        } else {
            return view("{$this->nomeView}.index", compact('data'))
                            ->with('tipo', $tipo)->with('id', $id)->with('nome', $nome)->with('conjuge', $conjuge);
        }
    }

    public function dependentesMinistroCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        return view("{$this->nomeView}.cadastrar-editar")->with('id', $id)->with('tipo', $tipo);
    }

    public function dependentesMinistroCadastrarDB($id) {
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
            return redirect("restrito/ministros/dependentes/$id")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function dependentesMinistroEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        $data = $this->model->find($id);
        return view("{$this->nomeView}.cadastrar-editar", compact('data'))->with('tipo', $tipo);
    }

    public function dependentesMinistroEditarDB($id) {
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
            return redirect("restrito/ministros/dependentes/$user_id->user_id")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    /* DEPENDENTES MISSIONÁRIAS */

    public function dependentesMissionaria($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $idConjuge = $this->users->where('id', $id)->select('user_id')->first();
        $idConjuge = $idConjuge->user_id;

        if ($idConjuge == null) {
            $data = $this->model->where('user_id', $id)->get();
        } else {
            $data = $this->model->where('user_id', $id)->orWhere('user_id', $idConjuge)->get();
        }

        $user = $this->users->find($id);
        $nome = $user->name;
        $conjuge = $user->conjuge;
        $tipo = 'missionarias';

        if (!isset($conjuge) || $conjuge == '' || $conjuge == null) {
            return view("{$this->nomeView}.index", compact('data'))->with('tipo', $tipo)
                            ->with('id', $id)->with('nome', $nome);
        } else {
            return view("{$this->nomeView}.index", compact('data'))
                            ->with('tipo', $tipo)->with('id', $id)->with('nome', $nome)->with('conjuge', $conjuge);
        }
    }

    public function dependentesMissionariaCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        return view("{$this->nomeView}.cadastrar-editar")->with('id', $id)->with('tipo', $tipo);
    }

    public function dependentesMissionariaCadastrarDB($id) {
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
            return redirect("restrito/missionarias/dependentes/$id")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function dependentesMissionariaEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        $data = $this->model->find($id);
        return view("{$this->nomeView}.cadastrar-editar", compact('data'))->with('tipo', $tipo);
    }

    public function dependentesMissionariaEditarDB($id) {
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
            return redirect("restrito/missionarias/dependentes/$user_id->user_id")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

}
