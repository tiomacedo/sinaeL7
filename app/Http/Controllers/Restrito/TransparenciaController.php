<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Receitas;
use App\Models\Debitos;
use App\Models\ReceitasTipo;
use App\Models\DebitosTipo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransparenciaController extends StandardController {

    protected $modelReceita;
    protected $modelDebito;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.transparencia';
    protected $redirectIndex = '/restrito/transparencia';

    public function __construct(Receitas $receitas, ReceitasTipo $receitasTipo, Debitos $debitos, DebitosTipo $debitosTipo, Request $request) {
        $this->modelReceitaTipo = $receitasTipo;
        $this->modelReceita = $receitas;
        $this->modelDebitoTipo = $debitosTipo;
        $this->modelDebito = $debitos;
        $this->request = $request;
        $this->gate = 'TRANSPARENCIA';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        //$teste = $this->modelReceitaTipo->all();
        //retorna os dados relacionados a consulta acima;
        //dd($teste->viewReceita);



        $tipoDebito = $this->modelDebitoTipo->get();
        $tipoReceita = $this->modelReceitaTipo->get();


        $RECJAN = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 1")
                ->get();
        $RECFEV = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 2")
                ->get();
        $RECMAR = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 3")
                ->get();
        $RECABR = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 4")
                ->get();
        $RECMAI = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 5")
                ->get();
        $RECJUN = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 6")
                ->get();
        $RECJUL = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 7")
                ->get();
        $RECAGO = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 8")
                ->get();
        $RECSET = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 9")
                ->get();
        $RECOUT = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 10")
                ->get();
        $RECNOV = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 11")
                ->get();
        $RECDEZ = $this->modelReceita
                ->groupBy(DB::raw('MONTH(REC_DTRECEBIMENTO)'), 'TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('MONTH(REC_DTRECEBIMENTO) as MES'), 'TR_CODIGO as COD')
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->whereRaw("MONTH(REC_DTRECEBIMENTO) = 12")
                ->get();
        $RECTOTAL = $this->modelReceita
                ->groupBy('TR_CODIGO')
                ->select(
                        DB::raw('SUM(REC_VALORRECEBIDO) as TOTAL'), DB::raw('TR_CODIGO as COD')
                )
                ->where('REC_DTRECEBIMENTO', '<>', NULL)
                ->get();




        $DEBJAN = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 1")
                ->get();
        $DEBFEV = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 2")
                ->get();
        $DEBMAR = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 3")
                ->get();
        $DEBABR = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 4")
                ->get();
        $DEBMAI = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 5")
                ->get();
        $DEBJUN = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 6")
                ->get();
        $DEBJUL = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 7")
                ->get();
        $DEBAGO = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 8")
                ->get();
        $DEBSET = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 9")
                ->get();
        $DEBOUT = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 10")
                ->get();
        $DEBNOV = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 11")
                ->get();
        $DEBDEZ = $this->modelDebito
                ->groupBy(DB::raw('MONTH(DEB_DTPAGAMENTO)'), 'TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('MONTH(DEB_DTPAGAMENTO) as MES'), 'TD_CODIGO as COD')
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->whereRaw("MONTH(DEB_DTPAGAMENTO) = 12")
                ->get();
        $DEBTOTAL = $this->modelDebito
                ->groupBy('TD_CODIGO')
                ->select(
                        DB::raw('SUM(DEB_VALOR) as TOTAL'), DB::raw('TD_CODIGO as COD')
                )
                ->where('DEB_DTPAGAMENTO', '<>', NULL)
                ->get();






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
        
        

//        dd($DEBTOTALGRAFICO);










        return view("{$this->nomeView}.index", compact(
                        'RECTOTALGRAFICO', 'DEBTOTALGRAFICO','RECJAN', 'RECFEV', 'RECMAR', 'RECABR', 'RECMAI', 'RECJUN', 'RECJUL', 'RECAGO', 'RECSET', 'RECOUT', 'RECNOV', 'RECDEZ', 'RECTOTAL', 'DEBJAN', 'DEBFEV', 'DEBMAR', 'DEBABR', 'DEBMAI', 'DEBJUN', 'DEBJUL', 'DEBAGO', 'DEBSET', 'DEBOUT', 'DEBNOV', 'DEBDEZ', 'DEBTOTAL', 'tipoReceita', 'tipoDebito'));
    }

}
