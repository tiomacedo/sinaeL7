<?php

namespace App\Http\Controllers\Restrito;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Receitas;
use App\Models\ReceitasTipo;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ReceitasController extends StandardController {

    protected $model;
    protected $users;
    protected $receitasTipo;
    protected $request;
    protected $gate;
    protected $nomeView = 'restrito.receitas';
    protected $redirectIndex = '/restrito/receitas';
    protected $redirectCadastrar = '/restrito/receitas/cadastrar';
    protected $redirectEditar = '/restrito/receitas/editar';

    public function __construct(Receitas $receitas, ReceitasTipo $tipo, User $users, Request $request) {
        $this->model = $receitas;
        $this->users = $users;
        $this->receitasTipo = $tipo;
        $this->request = $request;
        $this->gate = 'GERENCIAMENTO CONTABIL';
    }

    public function index() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->get();
        return view("{$this->nomeView}.index", compact('data'));
    }

    public function cadastrar() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $tipos = $this->receitasTipo->all();
        $users = $this->users
                ->where([['tp', 'MIN'], ['id', '>', 1]])
                ->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('tipos', 'users'));
    }

    public function cadastrarDB() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        if (isset($dadosForm['user_id']) && $dadosForm['user_id'] == '') {
            unset($dadosForm['user_id']);
        }
        if (isset($dadosForm['COMPLEMENTO']) && $dadosForm['COMPLEMENTO'] == '') {
            unset($dadosForm['COMPLEMENTO']);
        }

        $dataAtual = date('Y-m-d');
        $dtLancamento = array('REC_DTLANCAMENTO' => $dataAtual);
        $dadosForm = array_merge($dadosForm, $dtLancamento);
        $valor = str_replace(",", "", $dadosForm['REC_VALOR']);
        unset($dadosForm['REC_VALOR']);
        $valorTratado = array('REC_VALOR' => $valor);
        $dadosForm = array_merge($dadosForm, $valorTratado);
        $vlRecebido = array('REC_VALORRECEBIDO' => $valor);
        $dadosForm = array_merge($dadosForm, $vlRecebido);
        $status = array('REC_STATUS' => 'PAGO');
        $dadosForm = array_merge($dadosForm, $status);

        $validator = validator($dadosForm, $this->model->rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert = $this->model->create($dadosForm);
        }

        if ($insert) {
             return redirect()->back()
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
//            return redirect("$this->redirectIndex")
//                            ->with('status', 'success')
//                            ->with('titulo', 'Cadastro efetuado!')
//                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        }
    }

    public function editar($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model->find($id);
        $tipos = $this->receitasTipo->all();
        $users = $this->users->where([['tp', 'MIN'], ['id', '>', 1]])->get();
        return view("{$this->nomeView}.cadastrar-editar", compact('data', 'tipos', 'users'));
    }

    public function editarDB($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $rules = $this->model->rules;
        $rulesTratada = str_replace("((ID{?}))", $id, $rules);
        $dadosForm = $this->request->all();
        $dadosForm = array_map('strtoupper', $dadosForm);

        if (isset($dadosForm['user_id']) && $dadosForm['user_id'] == '') {
            unset($dadosForm['user_id']);
        }
        if (isset($dadosForm['COMPLEMENTO']) && $dadosForm['COMPLEMENTO'] == '') {
            unset($dadosForm['COMPLEMENTO']);
        }

        $dataAtual = date('Y-m-d');
        $dtLancamento = array('REC_DTLANCAMENTO' => $dataAtual);
        $dadosForm = array_merge($dadosForm, $dtLancamento);
        $valor = str_replace(",", "", $dadosForm['REC_VALOR']);
        unset($dadosForm['REC_VALOR']);
        $valorTratado = array('REC_VALOR' => $valor);
        $dadosForm = array_merge($dadosForm, $valorTratado);
        $vlRecebido = array('REC_VALORRECEBIDO' => $valor);
        $dadosForm = array_merge($dadosForm, $vlRecebido);

        $validator = validator($dadosForm, $rulesTratada);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $item = $this->model->find($id);
            $update = $item->update($dadosForm);
        }

        if ($update) {
            return redirect("$this->redirectIndex")
                            ->with('status', 'success')
                            ->with('titulo', 'Arquivo Alterado!')
                            ->with('mensagem', 'O registro foi modificado com sucesso!');
        }
    }

    public function gerarBoleto() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');
        $users = $this->users
                ->where('id', '<>', 1)
                ->get();
        $tipos = $this->modelTD->all();
        return view("{$this->nomeView}.gerar-boletos", compact('users', 'tipos'));
    }

    public function gerarBoletoMensalidade() {
        $gate = $this->gate;
        if (Gate::denies("$gate"))
            abort(403, 'Não Autorizado!');

        $dadosForm = $this->request->all();
        $user = $dadosForm['user_id'];
        dd('receitasControlles');
        // $qtd = count($dadosForm['user_id']);
        $di = $this->modelDI->first();

        /* -- ATENÇÃO --- */
        $codMensalidade = 1; /**/
        /* -- ATENÇÃO --- */

        //PREENCHIMENTO DA DATA CASO NÃO HAJA MES DE REFERÊNCIA
        $dataAtual = date('Y-m-d');
        //MESCLAGEM DO MÊS DE REFERENCIA
        if (isset($dadosForm['REC_DTREFERENCIA']) && $dadosForm['REC_DTREFERENCIA'] == '') {
            unset($dadosForm['REC_DTREFERENCIA']);
            $dt = array('REC_DTREFERENCIA' => $dataAtual);
            $dadosForm = array_merge($dadosForm, $dt);
        }

        //EXCUIR A INFORMAÇÃO DO RECEBIMENTO
        if (isset($dadosForm['REC_DTRECEBIMENTO']) && $dadosForm['REC_DTRECEBIMENTO'] == '') {
            unset($dadosForm['REC_DTRECEBIMENTO']);
            unset($dadosForm['REC_VALORRECEBIDO']);
        }

        //MUDAR CONFORME MUDE O CÓDIGO DA MENSALIDADE
        $trcodigo = array('TR_CODIGO' => $codMensalidade);
        $dadosForm = array_merge($dadosForm, $trcodigo);

        //DATA DA GERAÇÃO DO DOCUMENTO
        $dtLancamento = array('REC_DTLANCAMENTO' => $dataAtual);
        $dadosForm = array_merge($dadosForm, $dtLancamento);

        //RECEBER DA INFORMAÇÃO DE UMA TABELA //
        $valor = array('REC_VALOR' => 14.00);
        $dadosForm = array_merge($dadosForm, $valor);
        /*         * ****************************************  */


        //EXCLUI A INFORMAÇÃO DO user_id PARA ENTÃO INSERIR BOLETOS PARA TODOS //
        if (isset($dadosForm['user_id']) && $user[0] == 'TODOS') {
            unset($dadosForm['user_id']);
            // SELECIONANDO USUÁRIOS EM CASO DE SELEÇÃO DE TODOS USUÁRIOS //
            $usuarios = $this->users
                            ->where([['tx_mensal', 'SIM'], ['tp', 'MIN'],])->select('id')->get()->toArray();
                            dd('meu financeiro controlles');
            // $qtdUser = count($usuarios);
        }

        // VALIDAÇÃO DAS INFORMAÇÕES CONFORME A MODEL //
        /*
          $validator = validator($dadosForm, $this->model->rules);
          if ($validator->fails()) {
          $messages = $validator->messages();
          return $messages;
          }
         *
         */

        if (isset($dadosForm['restante-ano']) && $dadosForm['restante-ano'] == 'SIM') {
            $dtVencimento = date($dadosForm['REC_DTVENCIMENTO']);
            $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
            $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
            $mesAtual = date('m');
            $mesesRestantes = 13 - $mesAtual;
        }

        if (isset($usuarios) && (isset($dadosForm['restante-ano']) && $dadosForm['restante-ano'] == 'SIM')) {
            //dd('todos usuários -> impressão para restante do ano SIM');
            $m = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('m');
            while ($m <= 12) {
                $m = str_pad($m, 2, '0', STR_PAD_LEFT);
                $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
                $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
                $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');
                $prefixoNN = date("$ano$m");

                $i = 0;
                while ($i < $qtdUser) {
                    unset($dadosForm['REC_DTVENCIMENTO']);
                    $vencimento = array('REC_DTVENCIMENTO' => "$ano-$m-$dia");
                    $dadosForm = array_merge($dadosForm, $vencimento);
                    unset($dadosForm['REC_DTREFERENCIA']);
                    $referencia = array('REC_DTREFERENCIA' => "$ano-$m-01");
                    $dadosForm = array_merge($dadosForm, $referencia);

                    unset($dadosForm['user_id']);
                    $id = array('user_id' => implode(",", $usuarios[$i]));
                    $dadosForm = array_merge($dadosForm, $id);

                    unset($dadosForm['REC_NOSSONUMERO']);
                    $prefixo = str_pad(implode(",", $usuarios[$i]) . "$prefixoNN", 11, '0', STR_PAD_LEFT);
                    $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo" . "1");
                    $dadosForm = array_merge($dadosForm, $nossoNumero);

                    $validator = validator($dadosForm, $this->model->rules);
                    if ($validator->fails()) {
                        $messages = $validator->messages();
                        return $messages;
                    }

                    $insert = $this->model->create($dadosForm);

                    $i++;
                }
                $m++;
            }
        }
        if (isset($usuarios) && (isset($dadosForm['restante-ano']) && $dadosForm['restante-ano'] == 'NAO')) {
            $mesRef = Carbon::parse($dadosForm['REC_DTREFERENCIA'])->format('m');
            $m = str_pad($mesRef, 2, '0', STR_PAD_LEFT);
            $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
            $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
            $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');
            $prefixoNN = date("Y$mesRef");

            $i = 0;
            while ($i < $qtdUser) {
                unset($dadosForm['user_id']);
                $id = array('user_id' => implode(",", $usuarios[$i]));
                $dadosForm = array_merge($dadosForm, $id);
                unset($dadosForm['REC_NOSSONUMERO']);
                $prefixo = str_pad(implode(",", $usuarios[$i]) . "$prefixoNN", 11, '0', STR_PAD_LEFT);
                $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo" . "1");
                $dadosForm = array_merge($dadosForm, $nossoNumero);

                $validator = validator($dadosForm, $this->model->rules);
                if ($validator->fails()) {
                    $messages = $validator->messages();
                    return $messages;
                }
                $insert = $this->model->create($dadosForm);
                $i++;
            }
        }
        if (!isset($usuarios) && (isset($dadosForm['restante-ano']) && $dadosForm['restante-ano'] == 'SIM')) {
            $userForm = $dadosForm['user_id'];
            dd('meu financeiro controlles');
            // $qtd = count($dadosForm['user_id']);
            $m = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('m');

            if ($qtd > 1) {
                while ($m <= 12) {
                    $m = str_pad($m, 2, '0', STR_PAD_LEFT);
                    $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
                    $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
                    $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');
                    $prefixoNN = date("$ano$m");

                    $i = 0;
                    while ($i < $qtd) {
                        unset($dadosForm['REC_DTVENCIMENTO']);
                        $vencimento = array('REC_DTVENCIMENTO' => "$ano-$m-$dia");
                        $dadosForm = array_merge($dadosForm, $vencimento);
                        unset($dadosForm['REC_DTREFERENCIA']);
                        $referencia = array('REC_DTREFERENCIA' => "$ano-$m-01");
                        $dadosForm = array_merge($dadosForm, $referencia);

                        unset($dadosForm['user_id']);
                        $id = array('user_id' => $userForm[$i]);
                        $dadosForm = array_merge($dadosForm, $id);

                        unset($dadosForm['REC_NOSSONUMERO']);
                        $prefixo = str_pad($userForm[$i] . "$prefixoNN", 11, '0', STR_PAD_LEFT);
                        $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo" . "1");
                        $dadosForm = array_merge($dadosForm, $nossoNumero);

                        $validator = validator($dadosForm, $this->model->rules);
                        if ($validator->fails()) {
                            $messages = $validator->messages();
                            return $messages;
                        }
                        $insert = $this->model->create($dadosForm);

                        $i++;
                    }
                    $m++;
                }
            } else {
                $id = implode($dadosForm['user_id']);
                while ($m <= 12) {
                    $m = str_pad($m, 2, '0', STR_PAD_LEFT);
                    $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
                    $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
                    $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');
                    $prefixoNN = date("$ano$m");

                    unset($dadosForm['REC_DTVENCIMENTO']);
                    $vencimento = array('REC_DTVENCIMENTO' => "$ano-$m-$dia");
                    $dadosForm = array_merge($dadosForm, $vencimento);

                    unset($dadosForm['REC_DTREFERENCIA']);
                    $referencia = array('REC_DTREFERENCIA' => "$ano-$m-01");
                    $dadosForm = array_merge($dadosForm, $referencia);

                    unset($dadosForm['user_id']);
                    $user = array('user_id' => $id);
                    $dadosForm = array_merge($dadosForm, $user);

                    unset($dadosForm['REC_NOSSONUMERO']);
                    $prefixo = str_pad("$id$prefixoNN", 11, '0', STR_PAD_LEFT);
                    $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo" . "1");
                    $dadosForm = array_merge($dadosForm, $nossoNumero);

                    $validator = validator($dadosForm, $this->model->rules);
                    if ($validator->fails()) {
                        $messages = $validator->messages();
                        return $messages;
                    }
                    $insert = $this->model->create($dadosForm);
                    $m++;
                }
            }
        } // fim do elseif
        if (!isset($usuarios) && (isset($dadosForm['restante-ano']) && $dadosForm['restante-ano'] == 'NAO')) {
            $userForm = $dadosForm['user_id'];
            dd('meu financeiro controlles');
            // $qtd = count($dadosForm['user_id']);
            $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
            $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
            $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');
            $m = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('m');

            if ($qtd > 1) {
                $prefixoNN = date("$ano$m");

                $i = 0;
                while ($i < $qtd) {
                    unset($dadosForm['REC_DTVENCIMENTO']);
                    $vencimento = array('REC_DTVENCIMENTO' => "$ano-$m-$dia");
                    $dadosForm = array_merge($dadosForm, $vencimento);
                    unset($dadosForm['REC_DTREFERENCIA']);
                    $referencia = array('REC_DTREFERENCIA' => "$ano-$m-01");
                    $dadosForm = array_merge($dadosForm, $referencia);

                    unset($dadosForm['user_id']);
                    $id = array('user_id' => $userForm[$i]);
                    $dadosForm = array_merge($dadosForm, $id);

                    unset($dadosForm['REC_NOSSONUMERO']);
                    $prefixo = str_pad($userForm[$i] . "$prefixoNN", 11, '0', STR_PAD_LEFT);
                    $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo" . "1");
                    $dadosForm = array_merge($dadosForm, $nossoNumero);

                    $validator = validator($dadosForm, $this->model->rules);
                    if ($validator->fails()) {
                        $messages = $validator->messages();
                        return $messages;
                    }
                    $insert = $this->model->create($dadosForm);

                    $i++;
                }
            } else {
                $id = implode($dadosForm['user_id']);
                $m = str_pad($m, 2, '0', STR_PAD_LEFT);
                $dia = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('d');
                $ano = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('Y');
                $ano2d = Carbon::parse($dadosForm['REC_DTVENCIMENTO'])->format('y');
                $prefixoNN = date("$ano$m");

                unset($dadosForm['REC_DTVENCIMENTO']);
                $vencimento = array('REC_DTVENCIMENTO' => "$ano-$m-$dia");
                $dadosForm = array_merge($dadosForm, $vencimento);

                unset($dadosForm['REC_DTREFERENCIA']);
                $referencia = array('REC_DTREFERENCIA' => "$ano-$m-01");
                $dadosForm = array_merge($dadosForm, $referencia);

                unset($dadosForm['user_id']);
                $user = array('user_id' => $id);
                $dadosForm = array_merge($dadosForm, $user);

                unset($dadosForm['REC_NOSSONUMERO']);
                $prefixo = str_pad("$id$prefixoNN", 11, '0', STR_PAD_LEFT);
                $nossoNumero = array('REC_NOSSONUMERO' => "$m$ano2d$prefixo" . "1");
                $dadosForm = array_merge($dadosForm, $nossoNumero);

                $validator = validator($dadosForm, $this->model->rules);
                if ($validator->fails()) {
                    $messages = $validator->messages();
                    return $messages;
                }
                $insert = $this->model->create($dadosForm);
            }
        }

        if ($insert) {
            return redirect("$this->redirectIndex")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /* GerarBoletosMensalidade */
    public function gerarBoletoUnico() {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

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
            return redirect("$this->redirectIndex")
                            ->with('status', 'success')
                            ->with('titulo', 'Cadastro efetuado!')
                            ->with('mensagem', 'O registro foi inserido com sucesso!');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
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
        $users = $this->users->all();
        return view("{$this->nomeView}.boletos", compact('data', 'tipos', 'users'));
    }

    public function viewBoleto($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }
        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->find($id);

        $di = $this->modelDI->first();

        $beneficiario = new \Eduardokum\LaravelBoleto\Pessoa([
            'nome' => $di->DI_RAZAOSOCIAL,
            'endereco' => $di->DI_ENDERECO,
            'cep' => $di->DI_CEP,
            'uf' => $di->DI_UF,
            'cidade' => $di->DI_CIDADE,
            'documento' => $di->DI_CNPJ,
        ]);

        $pagador = new \Eduardokum\LaravelBoleto\Pessoa([
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
            'diasProtesto' => false, // protestar após, se for necessário //'numero' => 1,
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
        $boleto = new \Eduardokum\LaravelBoleto\Boleto\Banco\Caixa($boletoArray);

        return response($boleto->renderHTML());
    }

    public function enviarEmail($id) {
        $gate = $this->gate;
        if (Gate::denies("$gate")) {
            abort(403, 'Não Autorizado!');
        }

        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->where([['REC_CODIGO', $id], ['users.id', '<>', 1]])
                ->first();
        $id = Crypt::encrypt($id);
        $email = $data->email;

        $data = array(
            'id' => $id,
            'nome' => $data->name,
            'valor' => $data->REC_VALOR,
            'dtreferencia' => $data->REC_DTREFERENCIA,
            'nossonumero' => $data->REC_NOSSONUMERO,
            'descricao' => $data->TR_DESCRICAO,
            'email' => $data->email,
                //'from' => $data->email,
        );
        Mail::send('restrito.email-boleto.index', $data, function( $message ) use ($data) {
            $message->to($data['email'])->subject('Boleto Sistema Sinae');
        });

//        Mail::send('restrito.email-boleto.index', [
//            'id' => $id,
//            'nome' => $data->name,
//            'valor' => $data->REC_VALOR,
//            'dtreferencia' => $data->REC_DTREFERENCIA,
//            'nossonumero' => $data->REC_NOSSONUMERO,
//            'descricao' => $data->TR_DESCRICAO,
//            'email' => $data->email,
//                ], function ($mail) {
//            $mail->to($data->email, "Sistema Sinae")
//                    ->subject("");
//        });


        $emailEnviado = "sim";
        return redirect()->action('Restrito\ReceitasController@listarBoletos', compact('emailEnviado'));
    }

}