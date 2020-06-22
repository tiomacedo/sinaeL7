<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Eventos;
use Gate;

class EventosController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.eventos';
    protected $redirectIndex = '/restrito/eventos';
    protected $redirectCadastrar = '/restrito/eventos/cadastrar';
    protected $redirectEditar = '/restrito/eventos/editar';

    public function __construct(Eventos $eventos, Request $request) {
        $this->model = $eventos;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE EVENTOS';
    }

    public function age() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->where('EVEN_TIPO', 'AGE')->orderBy('EVEN_CODIGO', 'desc')->get();
        return view("{$this->nomeView}.index", compact('data'))->with('tipo', 'age');
    }

    public function ago() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->where('EVEN_TIPO', 'AGO')->orderBy('EVEN_CODIGO', 'desc')->get();
        return view("{$this->nomeView}.index", compact('data'))->with('tipo', 'ago');
    }

    public function cadastrarEvento($tipo) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        return view("{$this->nomeView}.cadastrar-editar")->with('tipo', strtoupper($tipo));
    }

    public function cadastrarDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $dadosForm = $this->request->all();
        $tipo = strtolower($dadosForm['EVEN_TIPO']);
        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        if ($insert) {
            return redirect("/restrito/eventos/$tipo")
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
        $tipo = strtolower($data->EVEN_TIPO);
        return view("{$this->nomeView}.cadastrar-editar", compact('data'))->with('tipo',$tipo);
    }
    
    public function editarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $tipo = strtolower($dadosForm['EVEN_TIPO']);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("/restrito/eventos/$tipo")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

}
