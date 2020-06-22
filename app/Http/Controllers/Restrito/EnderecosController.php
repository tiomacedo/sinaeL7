<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use App\Models\EnderecoIgreja;
USE App\Models\Cidades;
use Gate;

class EnderecosController extends StandardController {

    protected $model;
    protected $enderecoUser;
    protected $enderecoIgreja;
    protected $cidades;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.enderecos';
    protected $redirectIndex = '/restrito/enderecos';
    protected $redirectCadastrar = '/restrito/enderecos/cadastrar';
    protected $redirectEditar = '/restrito/enderecos/editar';

    public function __construct(Endereco $endereco, Cidades $cidades, EnderecoUsuario $enderecoUser, EnderecoIgreja $enderecoIgreja, Request $request) {
        $this->model = $endereco;
        $this->enderecoUser = $enderecoUser;
        $this->enderecoIgreja = $enderecoIgreja;
        $this->cidades = $cidades;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE AREAS E IGREJAS';
    }

    public function enderecoMinistroCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $tipo = 'ministros';
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('cidades'))
                        ->with('id', $id)
                        ->with('tipo', $tipo);
    }

    public function enderecoMinistroCadastrarDB($id) {
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
            /* inserir dados na tabela pivot enderecos_usuarios */
            $endereco = array('END_CODIGO' => $insert->END_CODIGO);
            $dados = array_merge($endereco, $user);
            $insertEndUser = $this->enderecoUser->create($dados);
        }

        if ($insert && $insertEndUser) {
            return redirect("restrito/ministros")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function enderecoMinistroEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        $data = $this->model->find($id);
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'cidades'))->with('tipo', $tipo);
    }

    public function enderecoMinistroEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
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

    /* endereço das missionárias */

    public function enderecoMissionariaCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $tipo = 'missionarias';
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('cidades'))
                        ->with('id', $id)
                        ->with('tipo', $tipo);
    }

    public function enderecoMissionariaCadastrarDB($id) {
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
            /* inserir dados na tabela pivot enderecos_usuarios */
            $endereco = array('END_CODIGO' => $insert->END_CODIGO);
            $dados = array_merge($endereco, $user);
            $insertEndUser = $this->enderecoUser->create($dados);
        }

        if ($insert && $insertEndUser) {
            return redirect("restrito/missionarias")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function enderecoMissionariaEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        $data = $this->model->find($id);
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'cidades'))->with('tipo', $tipo);
    }

    public function enderecoMissionariaEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
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

    /* endereço das igrejas */

    public function enderecoIgrejaCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'igrejas';
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('cidades'))
                        ->with('id', $id)
                        ->with('tipo', $tipo);
    }

    public function enderecoIgrejaCadastrarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $igreja = array('IGR_CODIGO' => $id);
        $dadosForm = array_merge($dadosForm, $igreja);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        if ($insert) {
            /* inserir dados na tabela pivot enderecos_usuarios */
            $endereco = array('END_CODIGO' => $insert->END_CODIGO);
            $dados = array_merge($endereco, $igreja);
            $insertEndIgreja = $this->enderecoIgreja->create($dados);
        }

        if ($insert && $insertEndIgreja) {
            return redirect("restrito/igrejas")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function enderecoIgrejaEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'igrejas';
        $data = $this->model->find($id);
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'cidades'))->with('tipo', $tipo);
    }

    public function enderecoIgrejaEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/igrejas")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

}
