<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\User;
use App\Models\Endereco;
use App\Models\Cidades;
use App\Models\EnderecoUsuario;
use App\Models\EnderecoIgreja;
use App\Models\Igrejas;
use App\Models\Areas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Image;

class MinhaAreaController extends StandardController {

    protected $users;
    protected $igrejas;
    protected $areas;
    protected $enderecos;
    protected $cidades;
    protected $enderecosIgreja;
    protected $enderecosUser;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.minha-area';
    protected $redirectIndex = '/restrito/minha-area';

    public function __construct(User $users, Cidades $cidades, Endereco $enderecos, Areas $areas, Igrejas $igrejas, EnderecoUsuario $enderecosUser, EnderecoIgreja $enderecosIgreja, Request $request) {
        $this->users = $users;
        $this->igrejas = $igrejas;
        $this->areas = $areas;
        $this->enderecos = $enderecos;
        $this->cidades = $cidades;
        $this->enderecosUser = $enderecosUser;
        $this->enderecosIgreja = $enderecosIgreja;
        $this->request = $request;
        $this->gate = 'MINHA ÁREA';
    }

    public function ministrosMissionarias() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('so eh presidente de campo');
            $igrejas = $this->igrejas->where('IGR_MATRICULA', $presidenteCampo)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            /* retorna os ministros cadastrados nas igrejas retornadas acima */
            $data = $this->users
                            ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', 'users.id')
                            ->where('id', '>', 1)->whereIn('IGR_CODIGO', $codigosIgrejas)->get();
            return view("{$this->nomeView}.ministros-missionarias", compact('data'));
        } else {
            //dd('presidente - SUPERVISOR');
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $igrejas = $this->igrejas->where('ARE_CODIGO', $area->ARE_CODIGO)->select('IGR_CODIGO')->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            /* retorna os ministros cadastrados nas igrejas retornadas acima */
            $data = $this->users
                            ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', 'users.id')
                            ->where('id', '>', 1)->whereIn('IGR_CODIGO', $codigosIgrejas)->get();
            return view("{$this->nomeView}.ministros-missionarias", compact('data'));
        }
    }

    /* endereço dos usuários */

    public function enderecoUsuarioCadastrar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $tipo = 'usuarios';
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();

        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('PRESIDENTE');
            $igrejas = $this->igrejas->where('IGR_MATRICULA', $presidenteCampo)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            $users = $this->users->where('id', '>', 1)->whereIn('IGR_CODIGO', $codigosIgrejas)->get();

            if ($users->contains($id)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        } else {
            //dd('SUPERVISOR');
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $igrejas = $this->igrejas->where('ARE_CODIGO', $area->ARE_CODIGO)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            $users = $this->users->where('id', '>', 1)->whereIn('IGR_CODIGO', $codigosIgrejas)->get();

            if ($users->contains($id)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }
    }

    public function enderecoUsuarioCadastrarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $user = array('user_id' => $id);
        $dadosForm = array_merge($dadosForm, $user);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $this->enderecos->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->enderecos->create($dadosForm);
        }

        if ($insert) {
            /* inserir dados na tabela pivot enderecos_usuarios */
            $endereco = array('END_CODIGO' => $insert->END_CODIGO);
            $dados = array_merge($endereco, $user);
            $insertEndUser = $this->enderecosUser->create($dados);
        }

        if ($insert && $insertEndUser) {
            return redirect("restrito/minha-area/ministros-missionarias")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function enderecoUsuarioEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipo = 'usuarios';
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();

        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('PRESIDENTE');
            $area = $this->areas->where('ARE_CODIGOMANUAL', $presidenteCampo)->first();
            $igrejas = $this->igrejas->where('IGR_MATRICULA', $presidenteCampo)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            $users = $this->users->where('id', '>', 1)->whereIn('IGR_CODIGO', $codigosIgrejas)->get();
            $enderecoUser = $this->enderecosUser->where('END_CODIGO', $id)->select('user_id', 'END_CODIGO')->first();
            $data = $this->enderecos->find($id);

            if ($users->contains($enderecoUser->user_id)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades', 'data'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        } else {
            //dd('SUPERVISOR');
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $igrejas = $this->igrejas->where('ARE_CODIGO', $area->ARE_CODIGO)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            $users = $this->users->where('id', '>', 1)->whereIn('IGR_CODIGO', $codigosIgrejas)->get();
            $enderecoUser = $this->enderecosUser->where('END_CODIGO', $id)->select('user_id', 'END_CODIGO')->first();
            $data = $this->enderecos->find($id);

            if ($users->contains($enderecoUser->user_id)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades', 'data'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }
    }

    public function enderecoUsuarioEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->enderecos->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->enderecos->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/minha-area/ministros-missionarias")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    /*     * ********************************************* */
    /* interação com as igrejas da área de supervisão */
    /*     * ********************************************* */

    public function igrejas() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('PRESIDENTE - supervisor');
            $data = $this->igrejas
                            ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', '=', 'igrejas.IGR_CODIGO')
                            ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_igrejas.END_CODIGO')
                            ->leftJoin('areas', 'igrejas.ARE_CODIGO', '=', 'areas.ARE_CODIGO')
                            ->select('areas.*', 'igrejas.*', 'igrejas.IGR_CODIGO as IGRCODIGO', 'enderecos_igrejas.*', 'enderecos.*')
                            ->where('IGR_MATRICULA', $presidenteCampo)->get();
            return view("{$this->nomeView}.igrejas", compact('data'));
        } else {
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $data = $this->igrejas
                            ->leftJoin('enderecos_igrejas', 'enderecos_igrejas.IGR_CODIGO', '=', 'igrejas.IGR_CODIGO')
                            ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_igrejas.END_CODIGO')
                            ->leftJoin('areas', 'igrejas.ARE_CODIGO', '=', 'areas.ARE_CODIGO')
                            ->select('areas.*', 'igrejas.*', 'igrejas.IGR_CODIGO as IGRCODIGO', 'enderecos_igrejas.*', 'enderecos.*')
                            ->where('ARE_CODIGOMANUAL', $supervisorArea)->get();
            return view("{$this->nomeView}.igrejas", compact('data'));
        }
    }

    public function igrejaEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('PRESIDENTE');

            $igrejas = $this->igrejas->where('IGR_MATRICULA', $presidenteCampo)->get();
            $areas = $this->areas->all();
            $data = $this->igrejas->find($id);
            $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();

            if ($igrejas->contains($data->IGR_CODIGO)) {
                return view("{$this->nomeView}.edit-igreja", compact('cidades', 'data', 'areas'))
                                ->with('id', $id)
                                ->with('tipo', 'igrejas');
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', 'igrejas')
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        } else {
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $igrejas = $this->igrejas->where('ARE_CODIGO', $area->ARE_CODIGO)->get();
            $areas = $this->areas->all();
            $data = $this->igrejas->find($id);
            $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();

            if ($igrejas->contains($data->IGR_CODIGO)) {
                return view("{$this->nomeView}.edit-igreja", compact('cidades', 'data', 'areas'))
                                ->with('id', $id)
                                ->with('tipo', 'igrejas');
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', 'igrejas')
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }
    }

    public function igrejaEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $igreja = $this->igrejas->find($id);

        $dadosForm = $this->request->all();

        if (isset($dadosForm['ARE_CODIGO'])) {
            unset($dadosForm['ARE_CODIGO']);
        }
        if (isset($dadosForm['CID_CODIGO'])) {
            unset($dadosForm['CID_CODIGO']);
        }
        if (isset($dadosForm['IGR_RESPONSAVEL'])) {
            unset($dadosForm['IGR_RESPONSAVEL']);
        }
        if (isset($dadosForm['IGR_MATRICULA'])) {
            unset($dadosForm['IGR_MATRICULA']);
        }
        if (isset($dadosForm['IGR_NOMECONGRECACAO'])) {
            unset($dadosForm['IGR_NOMECONGRECACAO']);
        }

        $area = array('ARE_CODIGO' => $igreja->ARE_CODIGO);
        $dadosForm = array_merge($dadosForm, $area);
        $cidade = array('CID_CODIGO' => $igreja->CID_CODIGO);
        $dadosForm = array_merge($dadosForm, $cidade);
        $responsavel = array('IGR_RESPONSAVEL' => $igreja->IGR_RESPONSAVEL);
        $dadosForm = array_merge($dadosForm, $responsavel);
        $matricula = array('IGR_MATRICULA' => $igreja->IGR_MATRICULA);
        $dadosForm = array_merge($dadosForm, $matricula);
        $nome = array('IGR_NOMECONGRECACAO' => $igreja->IGR_NOMECONGRECACAO);
        $dadosForm = array_merge($dadosForm, $nome);

        $validator = validator($dadosForm, $this->igrejas->rules);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->igrejas->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("$this->redirectIndex/igrejas")
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

        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('PRESIDENTE');
            $igrejas = $this->igrejas->where('IGR_MATRICULA', $presidenteCampo)->select('IGR_CODIGO')->get();

            if ($igrejas->contains($id)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }

        else {
            //dd('SUPERVISOR');
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $codigosAreas = $area->ARE_CODIGO;
            $igrejas = $this->igrejas->where('ARE_CODIGO', $codigosAreas)->select('IGR_CODIGO')->get();

            if ($igrejas->contains($id)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }

   
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

        $validator = validator($dadosForm, $this->enderecos->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->enderecos->create($dadosForm);
        }

        if ($insert) {
            /* inserir dados na tabela pivot enderecos_igrejas */
            $endereco = array('END_CODIGO' => $insert->END_CODIGO);
            $dados = array_merge($endereco, $igreja);
            $insertEndIgreja = $this->enderecosIgreja->create($dados);
        }

        if ($insert && $insertEndIgreja) {
            return redirect("restrito/minha-area/igrejas")
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
        $cidades = $this->cidades->whereIn('CID_UF', ['GO', 'DF', 'MG'])->get();

        $meuID = Auth::user()->id;
        $minhaArea = $this->users
                ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', 'users.id')
                ->select('id', 'DEM_PRESIDENTEDECAMPO', 'DEM_SUPERVISORCAMPO')
                ->where('id', $meuID)
                ->first();
        $presidenteCampo = $minhaArea->DEM_PRESIDENTEDECAMPO;
        $supervisorArea = $minhaArea->DEM_SUPERVISORCAMPO;

        if ($presidenteCampo != '' && $supervisorArea == '') {
            //dd('PRESIDENTE');
            
            $igrejas = $this->igrejas->where('IGR_MATRICULA', $presidenteCampo)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            $enderecoIgreja = $this->enderecosIgreja->where('END_CODIGO', $id)->select('IGR_CODIGO', 'END_CODIGO')->first();
            $data = $this->enderecos->find($id);

            if ($igrejas->contains($enderecoIgreja->IGR_CODIGO)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades', 'data'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }

        else {
            //dd('SUPERVISOR');
            $area = $this->areas->where('ARE_CODIGOMANUAL', $supervisorArea)->first();
            $igrejas = $this->igrejas->where('ARE_CODIGO', $area->ARE_CODIGO)->get();
            $codigosIgrejas = $array = array_pluck($igrejas, 'IGR_CODIGO');
            $enderecoIgreja = $this->enderecosIgreja->where('END_CODIGO', $id)->select('IGR_CODIGO', 'END_CODIGO')->first();
            $data = $this->enderecos->find($id);

            if ($igrejas->contains($enderecoIgreja->IGR_CODIGO)) {
                return view("{$this->nomeView}.edit-endereco", compact('cidades', 'data'))
                                ->with('id', $id)
                                ->with('tipo', $tipo);
            } else {
                return redirect()->back()
                                ->with('id', $id)
                                ->with('tipo', $tipo)
                                ->with('status', 'error')
                                ->with('titulo', 'Não permitido!')
                                ->with('mensagem', 'Você não tem permissão para alterar um endereco que não seja da sua área!');
            }
        }

       
    }

    public function enderecoIgrejaEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->enderecos->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->enderecos->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/minha-area/igrejas")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

}
