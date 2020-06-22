<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EnderecoUsuario;
use App\Models\DadosEclesiaticosMinistros;
use App\Models\DadosEclesiaticosMissionarias;
use App\Models\Dependentes;
use App\Models\DadosBancarios;
use App\Models\Igrejas;

class MeuPerfilController extends StandardController {

    protected $model;
    protected $igrejas;
    protected $modelEndereco;
    protected $modelDEMIN;
    protected $modelDEMIS;
    protected $modelDependente;
    protected $modelBank;
    protected $gate;
    protected $nomeView = 'restrito.meu-perfil';
    protected $redirectIndex = '/restrito/meu-perfil';

    public function __construct(User $user, Igrejas $igrejas, DadosEclesiaticosMinistros $demin, DadosEclesiaticosMissionarias $demis, EnderecoUsuario $endereco, Dependentes $dependente, DadosBancarios $dadosBancario) {
        $this->model = $user;
        $this->igrejas = $igrejas;
        $this->modelEndereco = $endereco;
        $this->modelDEMIN = $demin;
        $this->modelDEMIS = $demis;
        $this->modelDependente = $dependente;
        $this->modelBank = $dadosBancario;

        $this->gate = 'MEU PERFIL';
    }

    public function perfil() {
        $meuID = Auth::user()->id;
        $minhaIgreja = Auth::user()->IGR_CODIGO;
        $gate = $this->gate;
        if (Gate::denies("$gate")){
            abort(403, 'Não Autorizado!');
        }
            
        $data = $this->model
                ->leftJoin('cidades','cidades.CID_CODIGO', 'users.CID_CODIGO')
                ->where('id', $meuID)->get();
        $igrejas = $this->igrejas->where('IGR_CODIGO',$minhaIgreja)->first();
        $tp = $this->model->where('id', $meuID)->select('tp')->first();
        
        $enderecos = $this->modelEndereco
                ->leftJoin('enderecos', 'enderecos_usuarios.END_CODIGO','enderecos.END_CODIGO')
                ->leftJoin('cidades','cidades.CID_CODIGO', 'enderecos.CID_CODIGO')
                ->where('enderecos_usuarios.user_id', $meuID)->get();
        


        if ($tp->tp == 'MIS') {
            $dems = $this->modelDEMIS->where('user_id', $meuID)->get();
            
            $idMinistro = $this->model->where('id', $meuID)->select('user_id')->first();
            $dependentes = $this->modelDependente->where('user_id', $meuID)->orWhere('user_id', $idMinistro->user_id)->get();
        } else {
            $dems = $this->modelDEMIN->where('user_id', $meuID)->get();
            
            $idMissionaria = $this->model->where('user_id', $meuID)->select('id')->first();
            if($idMissionaria == null){
                $dependentes = $this->modelDependente->where('user_id', $meuID)->get();
            } else {
                $dependentes = $this->modelDependente->where('user_id', $meuID)->orWhere('user_id', $idMissionaria->id)->get();
            }
        }

        return view("{$this->nomeView}.index", compact('data','enderecos','dependentes','dems'))->with('igrejas',$igrejas);
    }

}
