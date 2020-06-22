<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\User;
use App\Models\DadosEclesiaticosMinistros;
use App\Models\DadosEclesiaticosMissionarias;
use App\Models\Credenciais;
use App\Models\DadosInstitucionais;
use Gate;
//use Carbon\Carbon;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\Validation\Validator;
//use Symfony\Component\Console\Input\Input;
//use Illuminate\Support\Facades\Input;

class CredenciaisController extends StandardController {

    protected $model;
    protected $di;
    protected $request;
    protected $nomeView = 'restrito.credenciais';
    protected $redirectIndex = '/restrito/user';
    protected $redirectCadastrar = '/restrito/user/cadastrar';
    protected $redirectEditar = '/restrito/user/editar';

    public function __construct(User $user, Credenciais $credenciais, DadosEclesiaticosMinistros $demin, 
            DadosEclesiaticosMissionarias $demis,
 DadosInstitucionais $di,
            Request $request) {

        $this->model = $credenciais;
        $this->di = $di;
        $this->modelUser = $user;
        $this->modelDEMIN = $demin;
        $this->modelDEMIS = $demis;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO DE CREDENCIAIS';
    }

    public function ministros() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $data = $this->model
                        ->leftJoin('users', 'credenciais.user_id', '=', 'users.id')
                        ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', '=', 'users.id')
                        ->where([
                            ['tp', 'MIN'],
                            ['foto', '<>', null],
                            ['dados_eclesiaticos_ministros.user_id', '<>', null],
                        ])->get();
        return view("{$this->nomeView}.index-ministros", compact('data'));
    }

    public function missionarias() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $data = $this->model
                ->leftJoin('users', 'credenciais.user_id', '=', 'users.id')
                ->leftJoin('dados_eclesiaticos_missionarias', 'dados_eclesiaticos_missionarias.user_id', '=', 'users.id')
                ->where([
                    ['tp', 'MIS'],
                    ['foto', '<>', null],
                    ['dados_eclesiaticos_missionarias.user_id', '<>', null],
                ])
                ->get();
        return view("{$this->nomeView}.index-missionarias", compact('data'));
    }

    public function editar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model->find($id);
        return response()->json($data);
    }

    public function editarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $dadosForm = $this->request->all();

        $dt = new \Carbon\Carbon($dadosForm['CREDEN_DTEMISSAO']);
        $dt->toDateTimeString();

        $validade = array('CREDEN_DTVALIDADE' => $dt->addYears(2)); //ADICIONANDO DOIS ANOS DE VALIDADE
        $dadosForm = array_merge($dadosForm, $validade);
        $idUser = $this->model->select('user_id')->where('CREDEN_CODIGO', $id)->first();
        $user_id = array('user_id' => $idUser->user_id);
        $dadosForm = array_merge($dadosForm, $user_id);

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        $item = $this->model->find($id);

        $update = $item->update($dadosForm);

        if ($update)
            return '1';
        else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function carteira($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        
        $di = $this->di->all()->first();
        $tipo = $this->model->leftJoin('users', 'credenciais.user_id', '=', 'users.id')->where('CREDEN_CODIGO', $id)->first();
        $tp = $tipo->tp;




        if ($tp == 'MIN') {
            $data = $this->model
                    ->leftJoin('users', 'credenciais.user_id', '=', 'users.id')
                    ->leftJoin('dados_eclesiaticos_ministros', 'dados_eclesiaticos_ministros.user_id', '=', 'users.id')
                    ->where('CREDEN_CODIGO', $id)
                    ->get();
            return view("{$this->nomeView}.ministro", compact('data'))->with('fone',$di->DI_FONE);
        }
        if ($tp == 'MIS') {
            $data = $this->model
                    ->leftJoin('users', 'credenciais.user_id', '=', 'users.id')
                    ->leftJoin('dados_eclesiaticos_missionarias', 'dados_eclesiaticos_missionarias.user_id', '=', 'users.id')
                    ->where('CREDEN_CODIGO', $id)
                    ->get();
            return view("{$this->nomeView}.missionaria", compact('data'))->with('fone',$di->DI_FONE);
        }







//        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML(view("{$this->nomeView}.ministro", compact('data')));
//        return $pdf->stream();
        //PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
    }

}
