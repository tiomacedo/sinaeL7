<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Patrimonios;
use Illuminate\Support\Facades\Gate;


class PatrimoniosController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.patrimonios';
    protected $redirectIndex = '/restrito/patrimonios';
    protected $redirectCadastrar = '/restrito/patrimonios/cadastrar';
    protected $redirectEditar = '/restrito/patrimonios/editar';

    public function __construct(Patrimonios $patrimonios, Request $request) {
        $this->model = $patrimonios;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO CONTABIL';
    }
    
    public function view($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $views = $this->model->find($id);
        return response()->json($views);
    }

    
    
    public function cadastrarDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);
        $valor = str_replace(",", "", $dadosForm['PAT_VALOR']);
        $valor = array('PAT_VALOR' => $valor);
        $dadosForm = array_merge($dadosForm, $valor);

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
    
    public function editarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);
        $valor = str_replace(",", "", $dadosForm['PAT_VALOR']);
        $valor = array('PAT_VALOR' => $valor);
        $dadosForm = array_merge($dadosForm, $valor);

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
