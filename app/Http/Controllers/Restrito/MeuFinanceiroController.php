<?php

namespace App\Http\Controllers\Restrito;

use App\Http\Controllers\StandardController;
use App\Models\DadosInstitucionais;
use App\Models\Receitas;
use App\Models\ReceitasTipo;
use App\Models\User;
use Carbon\Carbon;
use App\Models\DadosEclesiaticosMinistros;
use Eduardokum\LaravelBoleto\Boleto\Banco\Caixa;
use Eduardokum\LaravelBoleto\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Image;

class MeuFinanceiroController extends StandardController {

    protected $model;
    protected $modelDEM;
    protected $request;
    protected $gate;
    protected $nomeClasse;
    protected $nomeView = 'restrito.minhas-financas';
    protected $redirectIndex = '/restrito/minhas-financas';

    public function __construct(Receitas $receitas, ReceitasTipo $tipo, User $user, DadosEclesiaticosMinistros $dem, DadosInstitucionais $dadosInst, Request $request) {
        $this->model = $receitas;
        $this->modelUser = $user;
        $this->modelDEM = $dem;
        $this->modelTD = $tipo;
        $this->modelDI = $dadosInst;
        $this->request = $request;
        $this->gate = 'MINHAS FINANCAS';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $meuID = Auth::user()->id;
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->where('users.id', $meuID)
                ->get();
        $tipos = $this->modelTD->all();
        return view("{$this->nomeView}.index", compact('data', 'tipos'));
    }

    public function recibos() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $meuID = Auth::user()->id;
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->where([['users.id', $meuID], ['REC_DTRECEBIMENTO', '!=', NULL], ['REC_VALORRECEBIDO', '<>', NULL]])
                ->get();
        $tipos = $this->modelTD->all();
        return view("{$this->nomeView}.recibos", compact('data', 'tipos'));
    }

    public function contribuicoes() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $meuID = Auth::user()->id;
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->where('users.id', $meuID)
                ->get();
        $tipos = $this->modelTD->all();

        return view("restrito.minhas-contribuicoes.index", compact('data', 'tipos'));
    }

    public function contribuicoesCadastrar() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $tipos = $this->modelTD->all();
        $coletores = $this->modelDEM
                ->leftJoin('users', 'users.id', '=', 'dados_eclesiaticos_ministros.user_id')
                ->where('DEM_COLETOR', 'SIM')
                ->select('name', 'users.id')
                ->get();
        return view("restrito.minhas-contribuicoes.cadastrar", compact('tipos', 'coletores'));
    }

    public function contribuicoesCadastrarDB() {

        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $Items = $this->request->input('items'); // 2
        dd('meu financeiro controlles');
        // $qtdItems = count($Items); // 2
        $dadosForm = $this->request->all();
        
        $dataAtual = date('Y-m-d');
        $meuID = Auth::user()->id;
        $foto = $this->request->file('foto');

        $i = 0;

        if (isset($foto) && $foto->isValid()) {
            $rules = ['foto' => 'image|mimes:jpg,jpeg,png,bmp,gif|max:1024'];
            $validator = validator($dadosForm, $rules);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return $messages;
            }
            $nomeArquivo = "COMP_$dataAtual - USER_$meuID";
            $path = public_path('assets/comprovantes/');
            $uploadFoto = Image::make($foto)->resize('400', null)->encode('jpg', 100)->save($path . "$nomeArquivo.jpg");


            if ($uploadFoto) {
                while ($i < $qtdItems) {
                    $id = array('user_id' => $meuID);
                    $dadosForm = array_merge($dadosForm, $id);

                    $trcodigo = array('TR_CODIGO' => $dadosForm['items'][$i]['TR_CODIGO']);
                    $dadosForm = array_merge($dadosForm, $trcodigo);

                    $dtLancamento = array('REC_DTLANCAMENTO' => $dataAtual);
                    $dadosForm = array_merge($dadosForm, $dtLancamento);

                    $mesReferencia = array('REC_DTREFERENCIA' => $dadosForm['items'][$i]['REC_DTREFERENCIA']);
                    $dadosForm = array_merge($dadosForm, $mesReferencia);

                    $valorForm = array('REC_VALOR' => $dadosForm['items'][$i]['REC_VALOR']);
                    $valor = str_replace(",", "", $valorForm);
                    $dadosForm = array_merge($dadosForm, $valor);

                    $dtRecebimento = array('REC_DTRECEBIMENTO' => $dadosForm['REC_DTRECEBIMENTO']);
                    $dadosForm = array_merge($dadosForm, $dtRecebimento);

                    $status = $id = array('REC_STATUS' => 'PROCESSO DE CONFIRMAÇÃO');
                    $dadosForm = array_merge($dadosForm, $status);

                    $coletor = $id = array('REC_COLETOR' => $dadosForm['REC_COLETOR']);
                    $dadosForm = array_merge($dadosForm, $coletor);

                    $imagem = $id = array('REC_COMPROVANTE' => "$nomeArquivo.jpg");
                    $dadosForm = array_merge($dadosForm, $imagem);

                    $insert = $this->model->create($dadosForm);
                    $i++;
                }
            } else {
                //retorno se tiver dado erro em upload de imagem
            }
        } else {
            while ($i < $qtdItems) {
                $id = array('user_id' => $meuID);
                $dadosForm = array_merge($dadosForm, $id);

                $trcodigo = array('TR_CODIGO' => $dadosForm['items'][$i]['TR_CODIGO']);
                $dadosForm = array_merge($dadosForm, $trcodigo);

                $dtLancamento = array('REC_DTLANCAMENTO' => $dataAtual);
                $dadosForm = array_merge($dadosForm, $dtLancamento);

                $mesReferencia = array('REC_DTREFERENCIA' => $dadosForm['items'][$i]['REC_DTREFERENCIA']);
                $dadosForm = array_merge($dadosForm, $mesReferencia);

                $valorForm = array('REC_VALOR' => $dadosForm['items'][$i]['REC_VALOR']);
                $valor = str_replace(",", "", $valorForm);
                $dadosForm = array_merge($dadosForm, $valor);

                $dtRecebimento = array('REC_DTRECEBIMENTO' => $dadosForm['REC_DTRECEBIMENTO']);
                $dadosForm = array_merge($dadosForm, $dtRecebimento);

                $status = $id = array('REC_STATUS' => 'EM ANÁLISE');
                $dadosForm = array_merge($dadosForm, $status);

                $coletor = $id = array('REC_COLETOR' => $dadosForm['REC_COLETOR']);
                $dadosForm = array_merge($dadosForm, $coletor);

                $insert = $this->model->create($dadosForm);
                $i++;
            }
        }

        if ($insert) {
            return redirect("/restrito/minhas-contribuicoes")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        } else {
            $insert = $this->model->create($dadosForm);
        }
    }

    public function contribuicoesEditar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model->find($id);
        $tipos = $this->modelTD->all();
        $coletores = $this->modelDEM
                ->leftJoin('users', 'users.id', '=', 'dados_eclesiaticos_ministros.user_id')
                ->where('DEM_COLETOR', 'SIM')
                ->select('name', 'users.id')
                ->get();
        return view("restrito.minhas-contribuicoes.editar", compact('data','coletores','tipos'));
    }

    public function contribuicoesEditarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dtLancamento = $this->model->find($id);
        $dtLancamento = array('REC_DTLANCAMENTO' => $dtLancamento->REC_DTLANCAMENTO);
        $dadosForm = array_merge($dadosForm, $dtLancamento);
        $dadosForm = array_map('strtoupper', $dadosForm);

        $validator = validator($dadosForm, $rulesTratada);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
//            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("restrito/minhas-contribuicoes")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    public function contribuicoesExcluir($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $item = $this->model->find($id);
        $deleta = $item->delete();

        if ($deleta) {
            return '1';
        } else {
            return 'Falha ao Deletar arquivo!';
        }
    }

    /* GerarBoletosMensalidade */

    public function gerarBoletoUnico() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $dadosForm = $this->request->all();
        $user = $dadosForm['user_id'];
        $dataAtual = date('Y-m-d');

        $trcodigo = array('TR_CODIGO' => $dadosForm['TR_CODIGO']);
        $dadosForm = array_merge($dadosForm, $trcodigo);

        //INSERE A DATA DE FORMA MANUAL
        $dtLancamento = array('REC_DTLANCAMENTO' => $dataAtual);
        $dadosForm = array_merge($dadosForm, $dtLancamento);
        //TRATAMENTO DOS VALORES RECEBIDOS
        $valor = str_replace(",", "", $dadosForm['REC_VALOR']);
        unset($dadosForm['REC_VALOR']);
        $valorTratado = array('REC_VALOR' => $valor);
        $dadosForm = array_merge($dadosForm, $valorTratado);

        $validator = validator($dadosForm, $this->model->rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        }

        //INSERE A DATA DE FORMA MANUAL
        $prefixoNN = Carbon::parse($dadosForm['REC_DTREFERENCIA'])->format('Ym');
        $m = Carbon::parse($dadosForm['REC_DTREFERENCIA'])->format('m');
        $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');

        $trcod = $dadosForm['TR_CODIGO'];
        $prefixo = str_pad("$user$prefixoNN", 11, '0', STR_PAD_LEFT);
        $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo$trcod");
        $dadosForm = array_merge($dadosForm, $nossoNumero);

        $insert = $this->model->create($dadosForm);

        if ($insert) {
            $data = $this->model
                    ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                    ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                    ->where([['REC_DTRECEBIMENTO', '!=', NULL], ['REC_VALORRECEBIDO', '<>', NULL]])
                    ->get();
            $tipos = $this->modelTD->all();
            $users = $this->modelUser->all();
            return view("{$this->nomeView}.index", compact('data', 'tipos', 'users'));
        } else
            return 'Falha ao Cadastrar, erro inesperado!';
    }

    public function listarBoletos() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->where([['REC_NOSSONUMERO', '<>', NULL],])
                ->get();
        $tipos = $this->modelTD->all();
        $users = $this->modelUser->all();
        return view("{$this->nomeView}.boletos", compact('data', 'tipos', 'users'));
    }

    public function viewBoleto($id) {

        $meuID = Auth::user()->id;
        $ID = $this->model->find($id);
        $ID = $ID->user_id;

        $gate = $this->gate;
        if (Gate::denies("$gate") || $ID != $meuID)
            abort(403, 'Não Autorizado!');
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->find($id);


        $di = $this->modelDI->first();



        $beneficiario = new Pessoa([
            'nome' => $di->DI_RAZAOSOCIAL,
            'endereco' => $di->DI_ENDERECO,
            'cep' => $di->DI_CEP,
            'uf' => $di->DI_UF,
            'cidade' => $di->DI_CIDADE,
            'documento' => $di->DI_CNPJ,
        ]);

        $pagador = new Pessoa([
            'nome' => $data->name,
            'endereco' => "$data->END_LOGRADOURO $data->END_TIPOLOGRADOURO $data->END_NUMERO",
            'bairro' => $data->END_BAIRRO,
            'cep' => $data->END_CEP,
            'uf' => $data->END_UF,
            'cidade' => $data->END_CIDADE,
            'documento' => $data->cpf,
        ]);


        $boletoArray = [
            'logo' => 'assets/images/logoCimadseta.jpg', // Logo da empresa
            'dataVencimento' => new \Carbon\Carbon($data->REC_DTVENCIMENTO),
            'valor' => $data->REC_VALOR,
            'multa' => $di->DI_MULTA,
            'juros' => $di->DI_JUROS,
            'juros_apos' => $di->DI_JUROSAPOS, // juros e multa após
            'diasProtesto' => false, // protestar após, se for necessário
            //'numero' => 1,
            'numero' => $data->REC_NOSSONUMERO,
            'numeroDocumento' => $data->REC_NOSSONUMERO,
            'pagador' => $pagador, // Objeto PessoaContract
            'beneficiario' => $beneficiario, // Objeto PessoaContract
            'agencia' => $di->DI_AGENCIA, // BB, Bradesco, CEF, HSBC, Itáu
            'agenciaDv' => $di->DI_AGENCIA_DV, // se possuir
            'conta' => $di->DI_CONTA, // BB, Bradesco, CEF, HSBC, Itáu, Santander
            'contaDv' => $di->DI_CONTA_DV, // Bradesco, HSBC, Itáu
            'carteira' => $di->DI_CARTEIRA,
            'convenio' => $di->DI_CONVENIO, // BB
            //'variacaoCarteira' => 'RG', // BB
            //'range' => 99999, // HSBC
            'codigoCliente' => $di->DI_CODIGOCLIENTE, // Bradesco, CEF, Santander
            //'ios' => 0, // Santander
            'descricaoDemonstrativo' => [$di->DI_MENSAGEM1, $di->DI_MENSAGEM2, $di->DI_MENSAGEM3], // máximo de 5
            'instrucoes' => [$di->DI_INSTRUCAO1, $di->DI_INSTRUCAO2, $di->DI_INSTRUCAO3, $di->DI_INSTRUCAO4], // máximo de 5
            'aceite' => $di->DI_ACEITE,
            'especieDoc' => $di->DI_ESPECIEDOC,
        ];
        $boleto = new Caixa($boletoArray);

        return response($boleto->renderHTML());
    }

    public function viewRecibo($id) {
        $meuID = Auth::user()->id;
        $ID = $this->model->find($id);
        $ID = $ID->user_id;

        $gate = $this->gate;
        if (Gate::denies("$gate") || $ID != $meuID)
            abort(403, 'Não Autorizado!');
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->where([['REC_CODIGO', $id], ['users.id', $meuID], ['REC_DTRECEBIMENTO', '!=', NULL], ['REC_VALORRECEBIDO', '<>', NULL]])
                ->get();
        $tipos = $this->modelTD->all();
        $users = $this->modelUser->all();
        $Inst = $this->modelDI->first();


        $dt = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->where([['REC_CODIGO', $id], ['users.id', $meuID], ['REC_DTRECEBIMENTO', '!=', NULL], ['REC_VALORRECEBIDO', '<>', NULL]])
                ->first();




        $Dvenc = Carbon::parse($dt->REC_DTVENCIMENTO)->format('d');
        $Mvenc = Carbon::parse($dt->REC_DTVENCIMENTO)->format('m');
        $Yvenc = Carbon::parse($dt->REC_DTVENCIMENTO)->format('Y');
        $Drec = Carbon::parse($dt->REC_DTRECEBIMENTO)->format('d');
        $Mrec = Carbon::parse($dt->REC_DTRECEBIMENTO)->format('m');
        $Yrec = Carbon::parse($dt->REC_DTRECEBIMENTO)->format('Y');

        $dtvenc = Carbon::create($Yvenc, $Mvenc, $Dvenc, 0);
        $dtrec = Carbon::create($Yrec, $Mrec, $Drec, 0);



        if ($dtvenc < $dtrec) {
            $diasVencido = $dtvenc->diffInDays($dtrec);
        } else {
            $diasVencido = 0;
        }




        return view("{$this->nomeView}.invoice", compact('data', 'tipos', 'users', 'Inst', 'diasVencido'));
    }

}
