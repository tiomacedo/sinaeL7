<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Solicitacao;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolicitacaoController extends StandardController {

    protected $model;
    protected $request;
    protected $nomeView = 'restrito.solicitacoes';

    public function __construct(Solicitacao $solicitacao, Request $request) {
        $this->model = $solicitacao;
        $this->request = $request;
        $this->gate = 'FAZER SOLICITACAO';
    }

    public function index() {
        $id = Auth::user()->id;
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->where('solicitacoes.user_id', $id)
                ->leftJoin('users', 'users.id', '=', 'solicitacoes.user_id')
                ->get();
        return view("{$this->nomeView}.index", compact('data'));
    }

    public function viewSolicitacoes() {
        $id = Auth::user()->id;
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->leftJoin('users', 'users.id', '=', 'solicitacoes.user_id')->orderBy('SOL_CODIGO', 'DESC')->get();
        return view("{$this->nomeView}.responder", compact('data'));
    }

    public function responder($id) {
        $gate = 'RESPONDER SOLICITACAO';
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function responderDB($id) {
        $gate = 'RESPONDER SOLICITACAO';
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');


        $dadosForm = $this->request->all();
        $resposta = $dadosForm['SOL_RESPOSTA'];
        $item = $this->model->find($id);
        $update = $item->where('SOL_CODIGO', $id)->update(['SOL_RESPOSTA' => $resposta, 'SOL_STATUS' => 'ENCERRADO']);

        if ($update)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function deletarResposta($id) {
//        dd('fadsfasdf');
        $gate = 'RESPONDER SOLICITACAO';
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $item = $this->model->find($id);
        $update = $item->where('SOL_CODIGO', $id)->update(['SOL_RESPOSTA' => '', 'SOL_STATUS' => 'AGUARDANDO ATENDIMENTO']);
        if ($update)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function cadastrarDB() {
        $id = Auth::user()->id;
        $gate = $this->gate;

        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $dadosForm = $this->request->all();


        $id = array('user_id' => $id);
        $dadosForm = array_merge($dadosForm, $id);
        $status = array('SOL_STATUS' => 'AGUARDANDO ATENDIMENTO');
        $dadosForm = array_merge($dadosForm, $status);
        $resposta = array('SOL_RESPOSTA' => '');
        $dadosForm = array_merge($dadosForm, $resposta);
        $check = array('SOL_CHECK' => 'N');
        $dadosForm = array_merge($dadosForm, $check);



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
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
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

}
