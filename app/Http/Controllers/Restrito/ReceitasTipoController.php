<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\ReceitasTipo;


class ReceitasTipoController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.receitas-tipo';
    protected $redirectIndex = '/restrito/receitas-tipo';
    protected $redirectCadastrar = '/restrito/receitas-tipo/cadastrar';
    protected $redirectEditar = '/restrito/receitas-tipo/editar';

    public function __construct(ReceitasTipo $receitas, Request $request) {
        $this->model = $receitas;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO CONTABIL';
    }

}
