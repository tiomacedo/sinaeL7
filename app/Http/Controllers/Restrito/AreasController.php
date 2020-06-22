<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Areas;

class AreasController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.areas';
    protected $redirectIndex = '/restrito/areas';
    protected $redirectCadastrar = '/restrito/areas/cadastrar';
    protected $redirectEditar = '/restrito/areas/editar';

    public function __construct(Areas $areas, Request $request) {
        $this->model = $areas;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE AREAS E IGREJAS';
    }

}
