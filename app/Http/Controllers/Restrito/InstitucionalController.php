<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\DadosInstitucionais;


class InstitucionalController extends StandardController {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.institucional';
    protected $redirectIndex = '/restrito/institucional';

    public function __construct(DadosInstitucionais $di, Request $request) {
        $this->model = $di;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO INSTITUCIONAL';
    }

}
