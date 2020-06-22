<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Areas;
use App\Models\Igrejas;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;
use App\Models\Receitas;
use App\Models\Debitos;
use App\Models\ReceitasTipo;
use App\Models\DebitosTipo;

use App\Models\Eventos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestritoController extends Controller {

    protected $model;
    protected $nomeView = 'restrito._home';
    protected $modelReceita;
    protected $modelDebito;
    protected $gate;

    public function __construct(Eventos $eventos,
            Receitas $receitas, ReceitasTipo $receitasTipo, Debitos $debitos, DebitosTipo $debitosTipo, User $user, Areas $areas, Igrejas $igrejas, Endereco $enderecos, EnderecoUsuario $endUser) {

        $this->model = $user;
        $this->modelIgreja = $igrejas;
        $this->modelAreas = $areas;
        $this->modelEndereco = $enderecos;
        $this->modelEndUser = $endUser;
        $this->modelEventos = $eventos;

        $this->modelReceitaTipo = $receitasTipo;
        $this->modelReceita = $receitas;
        $this->modelDebitoTipo = $debitosTipo;
        $this->modelDebito = $debitos;



        $this->middleware('auth');
    }

    public function index() {

        $data = $this->model
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->limit(5)
                ->get();

        $id = Auth::user()->id;
        $debitosAberto = DB::select("select sum(REC_VALOR) as valor from receitas where user_id = $id");

        $dataAtual = date('Y-m-d');
        $debitosAtraso = DB::select("select sum(REC_VALOR) as valor from receitas where user_id = $id and REC_DTVENCIMENTO < '$dataAtual'");






        $RECTOTALGRAFICO = $this->modelReceita
                ->leftJoin('tipos_receitas', 'receitas.TR_CODIGO', '=', 'tipos_receitas.TR_CODIGO')
                ->groupBy('tipos_receitas.TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('tipos_receitas.TR_CODIGO as COD')
                )
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->get();


        $DEBTOTALGRAFICO = $this->modelDebito
                ->leftJoin('tipos_debitos', 'debitos.TD_CODIGO', '=', 'tipos_debitos.TD_CODIGO')
                ->groupBy('tipos_debitos.TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('tipos_debitos.TD_CODIGO as COD')
                )
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->get();

        $RECTOTAL = $this->modelReceita
                ->groupBy('TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('TR_CODIGO as COD')
                )
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->get();

        $DEBTOTAL = $this->modelDebito
                ->groupBy('TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('TD_CODIGO as COD')
                )
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->get();



        $tipoDebito = $this->modelDebitoTipo->get();
        $tipoReceita = $this->modelReceitaTipo->get();
        
        $dataAtual = date('Y-m-d');
        $agos = $this->modelEventos->where([['EVEN_TIPO','AGO'], ['EVEN_DTINICIO','>=',"$dataAtual"]])->orderBy('EVEN_DTINICIO','asc')->limit(1)->get();
        $ages = $this->modelEventos->where([['EVEN_TIPO','AGE'], ['EVEN_DTINICIO','>=',"$dataAtual"]])->orderBy('EVEN_DTINICIO','asc')->limit(1)->get();

        return view("{$this->nomeView}.index", compact('data', 'agos', 'ages', 'debitosAberto', 'RECTOTALGRAFICO', 'DEBTOTALGRAFICO', 'RECTOTAL', 'DEBTOTAL', 'tipoDebito', 'tipoReceita', 'debitosAtraso'
        ));
    }

}
