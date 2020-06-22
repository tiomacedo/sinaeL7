<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\DebitosTipo;


class DebitosTipoController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.debitos-tipo';
    protected $redirectIndex = '/restrito/debitos-tipo';
    protected $redirectCadastrar = '/restrito/debitos-tipo/cadastrar';
    protected $redirectEditar = '/restrito/debitos-tipo/editar';

    public function __construct(DebitosTipo $debitos, Request $request) {
        $this->model = $debitos;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO CONTABIL';
    }

}
