<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\DadosEclesiaticosMinistros;
use App\Models\DadosEclesiaticosMissionarias;
use App\Models\Areas;
use App\Models\Igrejas;
use Gate;

class DadosEclesiasticosController extends StandardController {

    protected $eclesiasticoMinistro;
    protected $eclesiasticoMissionaria;
    protected $areas;
    protected $igrejas;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.dados-eclesiasticos';
    protected $redirectIndex = '/restrito/dados-eclesiasticos';

    public function __construct(Areas $areas, Igrejas $igrejas, DadosEclesiaticosMinistros $deMin, DadosEclesiaticosMissionarias $deMis, Request $request) {
        $this->areas = $areas;
        $this->igrejas = $igrejas;
        $this->eclesiasticoMinistro = $deMin;
        $this->eclesiasticoMissionaria = $deMis;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE AREAS E IGREJAS';
    }

    public function DeMinistroCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        $areas = $this->areas->all();
        $igrejas = $this->igrejas->all();
        return view("{$this->nomeView}.ministros-cadastrar-editar", compact('areas','igrejas'))->with('id', $id)->with('tipo', $tipo);
    }
    
    public function DeMinistroCadastrarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $id = array('user_id' => $id);
        $dadosForm = array_merge($dadosForm, $id);

        if (isset($dadosForm['DEM_DTBATISMOAGUA']) && $dadosForm['DEM_DTBATISMOAGUA'] == '') {
            unset($dadosForm['DEM_DTBATISMOAGUA']);
        }

        if (isset($dadosForm['DEM_DTBATISMOESPIRITO']) && $dadosForm['DEM_DTBATISMOESPIRITO'] == '') {
            unset($dadosForm['DEM_DTBATISMOESPIRITO']);
        }

        if (isset($dadosForm['DEM_DTRECEBIDO']) && $dadosForm['DEM_DTRECEBIDO'] == '') {
            unset($dadosForm['DEM_DTRECEBIDO']);
        }
        if (isset($dadosForm['DEM_DTMUDANCA']) && $dadosForm['DEM_DTMUDANCA'] == '') {
            unset($dadosForm['DEM_DTMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTMUDANCADEAREA']) && $dadosForm['DEM_DTMUDANCADEAREA'] == '') {
            unset($dadosForm['DEM_DTMUDANCADEAREA']);
        }
        if (isset($dadosForm['DEM_DTDESLIGAMENTO']) && $dadosForm['DEM_DTDESLIGAMENTO'] == '') {
            unset($dadosForm['DEM_DTDESLIGAMENTO']);
        }
        if (isset($dadosForm['DEM_DTCONSAGRACAO']) && $dadosForm['DEM_DTCONSAGRACAO'] == '') {
            unset($dadosForm['DEM_DTCONSAGRACAO']);
        }
        if (isset($dadosForm['DEM_DTORDENACAO']) && $dadosForm['DEM_DTORDENACAO'] == '') {
            unset($dadosForm['DEM_DTORDENACAO']);
        }
        if (isset($dadosForm['DEM_DTJUBILADO']) && $dadosForm['DEM_DTJUBILADO'] == '') {
            unset($dadosForm['DEM_DTJUBILADO']);
        }
        if (isset($dadosForm['DEM_DTAUXILIAR']) && $dadosForm['DEM_DTAUXILIAR'] == '') {
            unset($dadosForm['DEM_DTAUXILIAR']);
        }
        if (isset($dadosForm['DEM_DTDIACONO']) && $dadosForm['DEM_DTDIACONO'] == '') {
            unset($dadosForm['DEM_DTDIACONO']);
        }
        if (isset($dadosForm['DEM_DTPRESBITERO']) && $dadosForm['DEM_DTPRESBITERO'] == '') {
            unset($dadosForm['DEM_DTPRESBITERO']);
        }
        if (isset($dadosForm['DEM_DTEVANGELISTA']) && $dadosForm['DEM_DTEVANGELISTA'] == '') {
            unset($dadosForm['DEM_DTEVANGELISTA']);
        }
        if (isset($dadosForm['DEM_DTPASTOR']) && $dadosForm['DEM_DTPASTOR'] == '') {
            unset($dadosForm['DEM_DTPASTOR']);
        }
        if (isset($dadosForm['DEM_DTDIRIGENTE']) && $dadosForm['DEM_DTDIRIGENTE'] == '') {
            unset($dadosForm['DEM_DTDIRIGENTE']);
        }
        if (isset($dadosForm['DEM_DTCONVERSAO']) && $dadosForm['DEM_DTCONVERSAO'] == '') {
            unset($dadosForm['DEM_DTCONVERSAO']);
        }
        if (isset($dadosForm['DEM_DTCARTAMUDANCA']) && $dadosForm['DEM_DTCARTAMUDANCA'] == '') {
            unset($dadosForm['DEM_DTCARTAMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTACLAMACAO']) && $dadosForm['DEM_DTACLAMACAO'] == '') {
            unset($dadosForm['DEM_DTACLAMACAO']);
        }
        if (isset($dadosForm['DEM_DTCONGREGADODESDE']) && $dadosForm['DEM_DTCONGREGADODESDE'] == '') {
            unset($dadosForm['DEM_DTCONGREGADODESDE']);
        }
        if (isset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']) && $dadosForm['DEM_DTDEPARTAMENTOIGREJA'] == '') {
            unset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $this->eclesiasticoMinistro->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->eclesiasticoMinistro->create($dadosForm);
        }

        if ($insert) {
            return redirect("restrito/ministros")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function DeMinistroEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'ministros';
        $data = $this->eclesiasticoMinistro->find($id);
        $areas = $this->areas->all();
        $igrejas = $this->igrejas->all();
        return view("{$this->nomeView}.ministros-cadastrar-editar", compact('data', 'areas','igrejas'))->with('tipo', $tipo);
    }

    public function DeMinistroEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->eclesiasticoMinistro->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);

        $dadosForm = $this->request->all();
        $user_id = $this->eclesiasticoMinistro->find($id);
        $user = array('user_id' => $user_id->user_id);
        $dadosForm = array_merge($dadosForm, $user);

        if (isset($dadosForm['DEM_DTBATISMOAGUA']) && $dadosForm['DEM_DTBATISMOAGUA'] == '') {
            unset($dadosForm['DEM_DTBATISMOAGUA']);
        }

        if (isset($dadosForm['DEM_DTBATISMOESPIRITO']) && $dadosForm['DEM_DTBATISMOESPIRITO'] == '') {
            unset($dadosForm['DEM_DTBATISMOESPIRITO']);
        }

        if (isset($dadosForm['DEM_DTRECEBIDO']) && $dadosForm['DEM_DTRECEBIDO'] == '') {
            unset($dadosForm['DEM_DTRECEBIDO']);
        }
        if (isset($dadosForm['DEM_DTMUDANCA']) && $dadosForm['DEM_DTMUDANCA'] == '') {
            unset($dadosForm['DEM_DTMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTMUDANCADEAREA']) && $dadosForm['DEM_DTMUDANCADEAREA'] == '') {
            unset($dadosForm['DEM_DTMUDANCADEAREA']);
        }
        if (isset($dadosForm['DEM_DTDESLIGAMENTO']) && $dadosForm['DEM_DTDESLIGAMENTO'] == '') {
            unset($dadosForm['DEM_DTDESLIGAMENTO']);
        }
        if (isset($dadosForm['DEM_DTCONSAGRACAO']) && $dadosForm['DEM_DTCONSAGRACAO'] == '') {
            unset($dadosForm['DEM_DTCONSAGRACAO']);
        }
        if (isset($dadosForm['DEM_DTORDENACAO']) && $dadosForm['DEM_DTORDENACAO'] == '') {
            unset($dadosForm['DEM_DTORDENACAO']);
        }
        if (isset($dadosForm['DEM_DTJUBILADO']) && $dadosForm['DEM_DTJUBILADO'] == '') {
            unset($dadosForm['DEM_DTJUBILADO']);
        }
        if (isset($dadosForm['DEM_DTAUXILIAR']) && $dadosForm['DEM_DTAUXILIAR'] == '') {
            unset($dadosForm['DEM_DTAUXILIAR']);
        }
        if (isset($dadosForm['DEM_DTDIACONO']) && $dadosForm['DEM_DTDIACONO'] == '') {
            unset($dadosForm['DEM_DTDIACONO']);
        }
        if (isset($dadosForm['DEM_DTPRESBITERO']) && $dadosForm['DEM_DTPRESBITERO'] == '') {
            unset($dadosForm['DEM_DTPRESBITERO']);
        }
        if (isset($dadosForm['DEM_DTEVANGELISTA']) && $dadosForm['DEM_DTEVANGELISTA'] == '') {
            unset($dadosForm['DEM_DTEVANGELISTA']);
        }
        if (isset($dadosForm['DEM_DTPASTOR']) && $dadosForm['DEM_DTPASTOR'] == '') {
            unset($dadosForm['DEM_DTPASTOR']);
        }
        if (isset($dadosForm['DEM_DTDIRIGENTE']) && $dadosForm['DEM_DTDIRIGENTE'] == '') {
            unset($dadosForm['DEM_DTDIRIGENTE']);
        }
        if (isset($dadosForm['DEM_DTCONVERSAO']) && $dadosForm['DEM_DTCONVERSAO'] == '') {
            unset($dadosForm['DEM_DTCONVERSAO']);
        }
        if (isset($dadosForm['DEM_DTCARTAMUDANCA']) && $dadosForm['DEM_DTCARTAMUDANCA'] == '') {
            unset($dadosForm['DEM_DTCARTAMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTACLAMACAO']) && $dadosForm['DEM_DTACLAMACAO'] == '') {
            unset($dadosForm['DEM_DTACLAMACAO']);
        }
        if (isset($dadosForm['DEM_DTCONGREGADODESDE']) && $dadosForm['DEM_DTCONGREGADODESDE'] == '') {
            unset($dadosForm['DEM_DTCONGREGADODESDE']);
        }
        if (isset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']) && $dadosForm['DEM_DTDEPARTAMENTOIGREJA'] == '') {
            unset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->eclesiasticoMinistro->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/ministros")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    public function DeMissionariaCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        $areas = $this->areas->all();
        return view("{$this->nomeView}.missionarias-cadastrar-editar", compact('areas'))->with('id', $id)->with('tipo', $tipo);
    }

    public function DeMissionariaCadastrarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $id = array('user_id' => $id);
        $dadosForm = array_merge($dadosForm, $id);
        $atividade = array('DEM_ATIVIDADE' => 'MISSIONÁRIA'); /* insere a atividade da missionaria */
        $dadosForm = array_merge($dadosForm, $atividade);

        if (isset($dadosForm['DEM_DTBATISMOAGUA']) && $dadosForm['DEM_DTBATISMOAGUA'] == '') {
            unset($dadosForm['DEM_DTBATISMOAGUA']);
        }

        if (isset($dadosForm['DEM_DTBATISMOESPIRITO']) && $dadosForm['DEM_DTBATISMOESPIRITO'] == '') {
            unset($dadosForm['DEM_DTBATISMOESPIRITO']);
        }

        if (isset($dadosForm['DEM_DTRECEBIDO']) && $dadosForm['DEM_DTRECEBIDO'] == '') {
            unset($dadosForm['DEM_DTRECEBIDO']);
        }
        if (isset($dadosForm['DEM_DTMUDANCA']) && $dadosForm['DEM_DTMUDANCA'] == '') {
            unset($dadosForm['DEM_DTMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTMUDANCADEAREA']) && $dadosForm['DEM_DTMUDANCADEAREA'] == '') {
            unset($dadosForm['DEM_DTMUDANCADEAREA']);
        }
        if (isset($dadosForm['DEM_DTDESLIGAMENTO']) && $dadosForm['DEM_DTDESLIGAMENTO'] == '') {
            unset($dadosForm['DEM_DTDESLIGAMENTO']);
        }
        if (isset($dadosForm['DEM_DTCONSAGRACAO']) && $dadosForm['DEM_DTCONSAGRACAO'] == '') {
            unset($dadosForm['DEM_DTCONSAGRACAO']);
        }
        if (isset($dadosForm['DEM_DTORDENACAO']) && $dadosForm['DEM_DTORDENACAO'] == '') {
            unset($dadosForm['DEM_DTORDENACAO']);
        }
        if (isset($dadosForm['DEM_DTJUBILADO']) && $dadosForm['DEM_DTJUBILADO'] == '') {
            unset($dadosForm['DEM_DTJUBILADO']);
        }
        if (isset($dadosForm['DEM_DTAUXILIAR']) && $dadosForm['DEM_DTAUXILIAR'] == '') {
            unset($dadosForm['DEM_DTAUXILIAR']);
        }
        if (isset($dadosForm['DEM_DTDIACONO']) && $dadosForm['DEM_DTDIACONO'] == '') {
            unset($dadosForm['DEM_DTDIACONO']);
        }
        if (isset($dadosForm['DEM_DTPRESBITERO']) && $dadosForm['DEM_DTPRESBITERO'] == '') {
            unset($dadosForm['DEM_DTPRESBITERO']);
        }
        if (isset($dadosForm['DEM_DTEVANGELISTA']) && $dadosForm['DEM_DTEVANGELISTA'] == '') {
            unset($dadosForm['DEM_DTEVANGELISTA']);
        }
        if (isset($dadosForm['DEM_DTPASTOR']) && $dadosForm['DEM_DTPASTOR'] == '') {
            unset($dadosForm['DEM_DTPASTOR']);
        }
        if (isset($dadosForm['DEM_DTDIRIGENTE']) && $dadosForm['DEM_DTDIRIGENTE'] == '') {
            unset($dadosForm['DEM_DTDIRIGENTE']);
        }
        if (isset($dadosForm['DEM_DTCONVERSAO']) && $dadosForm['DEM_DTCONVERSAO'] == '') {
            unset($dadosForm['DEM_DTCONVERSAO']);
        }
        if (isset($dadosForm['DEM_DTCARTAMUDANCA']) && $dadosForm['DEM_DTCARTAMUDANCA'] == '') {
            unset($dadosForm['DEM_DTCARTAMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTACLAMACAO']) && $dadosForm['DEM_DTACLAMACAO'] == '') {
            unset($dadosForm['DEM_DTACLAMACAO']);
        }
        if (isset($dadosForm['DEM_DTCONGREGADODESDE']) && $dadosForm['DEM_DTCONGREGADODESDE'] == '') {
            unset($dadosForm['DEM_DTCONGREGADODESDE']);
        }
        if (isset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']) && $dadosForm['DEM_DTDEPARTAMENTOIGREJA'] == '') {
            unset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $this->eclesiasticoMissionaria->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->eclesiasticoMissionaria->create($dadosForm);
        }

        if ($insert) {
            return redirect("restrito/missionarias")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function DeMissionariaEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'missionarias';
        $data = $this->eclesiasticoMissionaria->find($id);
        $areas = $this->areas->all();
        return view("{$this->nomeView}.missionarias-cadastrar-editar", compact('data', 'areas'))->with('tipo', $tipo);
    }

    public function DeMissionariaEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->eclesiasticoMissionaria->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);

        $dadosForm = $this->request->all();
        $user_id = $this->eclesiasticoMissionaria->find($id);
        $user = array('user_id' => $user_id->user_id);
        $dadosForm = array_merge($dadosForm, $user);
        $atividade = array('DEM_ATIVIDADE' => 'MISSIONÁRIA'); /* insere a atividade da missionaria */
        $dadosForm = array_merge($dadosForm, $atividade);

        if (isset($dadosForm['DEM_DTBATISMOAGUA']) && $dadosForm['DEM_DTBATISMOAGUA'] == '') {
            unset($dadosForm['DEM_DTBATISMOAGUA']);
        }

        if (isset($dadosForm['DEM_DTBATISMOESPIRITO']) && $dadosForm['DEM_DTBATISMOESPIRITO'] == '') {
            unset($dadosForm['DEM_DTBATISMOESPIRITO']);
        }

        if (isset($dadosForm['DEM_DTRECEBIDO']) && $dadosForm['DEM_DTRECEBIDO'] == '') {
            unset($dadosForm['DEM_DTRECEBIDO']);
        }
        if (isset($dadosForm['DEM_DTMUDANCA']) && $dadosForm['DEM_DTMUDANCA'] == '') {
            unset($dadosForm['DEM_DTMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTMUDANCADEAREA']) && $dadosForm['DEM_DTMUDANCADEAREA'] == '') {
            unset($dadosForm['DEM_DTMUDANCADEAREA']);
        }
        if (isset($dadosForm['DEM_DTDESLIGAMENTO']) && $dadosForm['DEM_DTDESLIGAMENTO'] == '') {
            unset($dadosForm['DEM_DTDESLIGAMENTO']);
        }
        if (isset($dadosForm['DEM_DTCONSAGRACAO']) && $dadosForm['DEM_DTCONSAGRACAO'] == '') {
            unset($dadosForm['DEM_DTCONSAGRACAO']);
        }
        if (isset($dadosForm['DEM_DTORDENACAO']) && $dadosForm['DEM_DTORDENACAO'] == '') {
            unset($dadosForm['DEM_DTORDENACAO']);
        }
        if (isset($dadosForm['DEM_DTJUBILADO']) && $dadosForm['DEM_DTJUBILADO'] == '') {
            unset($dadosForm['DEM_DTJUBILADO']);
        }
        if (isset($dadosForm['DEM_DTAUXILIAR']) && $dadosForm['DEM_DTAUXILIAR'] == '') {
            unset($dadosForm['DEM_DTAUXILIAR']);
        }
        if (isset($dadosForm['DEM_DTDIACONO']) && $dadosForm['DEM_DTDIACONO'] == '') {
            unset($dadosForm['DEM_DTDIACONO']);
        }
        if (isset($dadosForm['DEM_DTPRESBITERO']) && $dadosForm['DEM_DTPRESBITERO'] == '') {
            unset($dadosForm['DEM_DTPRESBITERO']);
        }
        if (isset($dadosForm['DEM_DTEVANGELISTA']) && $dadosForm['DEM_DTEVANGELISTA'] == '') {
            unset($dadosForm['DEM_DTEVANGELISTA']);
        }
        if (isset($dadosForm['DEM_DTPASTOR']) && $dadosForm['DEM_DTPASTOR'] == '') {
            unset($dadosForm['DEM_DTPASTOR']);
        }
        if (isset($dadosForm['DEM_DTDIRIGENTE']) && $dadosForm['DEM_DTDIRIGENTE'] == '') {
            unset($dadosForm['DEM_DTDIRIGENTE']);
        }
        if (isset($dadosForm['DEM_DTCONVERSAO']) && $dadosForm['DEM_DTCONVERSAO'] == '') {
            unset($dadosForm['DEM_DTCONVERSAO']);
        }
        if (isset($dadosForm['DEM_DTCARTAMUDANCA']) && $dadosForm['DEM_DTCARTAMUDANCA'] == '') {
            unset($dadosForm['DEM_DTCARTAMUDANCA']);
        }
        if (isset($dadosForm['DEM_DTACLAMACAO']) && $dadosForm['DEM_DTACLAMACAO'] == '') {
            unset($dadosForm['DEM_DTACLAMACAO']);
        }
        if (isset($dadosForm['DEM_DTCONGREGADODESDE']) && $dadosForm['DEM_DTCONGREGADODESDE'] == '') {
            unset($dadosForm['DEM_DTCONGREGADODESDE']);
        }
        if (isset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']) && $dadosForm['DEM_DTDEPARTAMENTOIGREJA'] == '') {
            unset($dadosForm['DEM_DTDEPARTAMENTOIGREJA']);
        }

        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->eclesiasticoMissionaria->find($id);
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
