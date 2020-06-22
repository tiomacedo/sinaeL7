<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Receitas;
use App\Models\ReceitasTipo;
use App\Models\DadosInstitucionais;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;



class PublicReceitasController extends Controller {

    protected $model;
    protected $request;
    protected $gate;
    protected $nomeView = 'site.receitas';
    protected $redirectIndex = '/site/receitas';

    public function __construct(Receitas $receitas, ReceitasTipo $tipo, User $user, DadosInstitucionais $dadosInst, Request $request) {
        $this->model = $receitas;
        $this->modelUser = $user;
        $this->modelTD = $tipo;
        $this->modelDI = $dadosInst;
        $this->request = $request;
    }


    public function index($id) {
        $id = Crypt::decrypt($id);

        $data = $this->model
                ->leftJoin('tipos_receitas', 'tipos_receitas.TR_CODIGO', '=', 'receitas.TR_CODIGO')
                ->leftJoin('users', 'users.id', '=', 'receitas.user_id')
                ->leftJoin('enderecos_usuarios', 'enderecos_usuarios.user_id', '=', 'users.id')
                ->leftJoin('enderecos', 'enderecos.END_CODIGO', '=', 'enderecos_usuarios.END_CODIGO')
                ->where('REC_CODIGO',$id)
                ->first();

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
        $boleto = new \Eduardokum\LaravelBoleto\Boleto\Banco\Caixa($boletoArray);

        return response($boleto->renderHTML());
    }

  
}
