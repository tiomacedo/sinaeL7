<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DadosInstitucionais extends Model  {

    use SoftDeletes;

    protected $table = 'dados_institucionais';
    protected $primaryKey = 'DI_CODIGO';
    protected $fillable = [
        'DI_NOMEFANTASIA', 'DI_RAZAOSOCIAL', 'DI_INSCRICAOMUNICIPAL', 'DI_INSCRICAOESTADUAL', 
	'DI_CNPJ', 'DI_ENDERECO', 'DI_CIDADE', 'DI_UF', 'DI_CEP', 'DI_LOGO', 'DI_AGENCIA', 'DI_AGENCIA_DV', 
	'DI_CONTA', 'DI_CONTA_DV', 'DI_MENSALIDADE', 'DI_MULTA', 'DI_JUROS', 'DI_JUROSAPOS', 'DI_DIASPROTESTO', 
	'DI_CARTEIRA', 'DI_VARIACAOCARTEIRA', 'DI_CONVENIO', 'DI_RANGE', 'DI_CODIGOCLIENTE', 'DI_MENSAGEM1', 
	'DI_MENSAGEM2', 'DI_MENSAGEM3', 'DI_INSTRUCAO1', 'DI_INSTRUCAO2', 'DI_INSTRUCAO3', 'DI_INSTRUCAO4', 
	'DI_INSTRUCAO5', 'DI_ACEITE', 'DI_ESPECIEDOC','DI_FONE'
    ];
    public $rules = [
        'DI_NOMEFANTASIA' => 'required|max:200',
	'DI_FONE' => 'required',
        'DI_RAZAOSOCIAL' => 'required|max:200',
        'DI_INSCRICAOMUNICIPAL' => 'max:20',
        'DI_INSCRICAOESTADUAL' => 'max:20',
        'DI_CNPJ' => 'required|max:20',
        'DI_ENDERECO' => 'required|max:200',
        'DI_CIDADE' => 'required|max:120',
        'DI_UF' => 'required|max:2',
        'DI_CEP' => 'required|max:10',
        'DI_LOGO' => 'max:50',
        'DI_AGENCIA' => 'required|max:10',
        'DI_AGENCIA_DV' => 'numeric',
        'DI_CONTA' => 'required|max:10',
        'DI_CONTA_DV' => 'numeric',
        'DI_MENSALIDADE' => 'required',
        'DI_MULTA' => '',
        'DI_JUROS' => '',
        'DI_JUROSAPOS' => '',
        'DI_DIASPROTESTO' => '',
        'DI_CARTEIRA' => 'max:20',
//        'DI_CARTEIRA' => 'required|max:20',
        'DI_VARIACAOCARTEIRA' => 'max:20',
        'DI_CONVENIO' => 'max:20',
//        'DI_CONVENIO' => 'required|max:20',
        'DI_RANGE' => 'max:20',
        'DI_CODIGOCLIENTE' => 'max:20',
//        'DI_CODIGOCLIENTE' => 'required|max:20',
        'DI_MENSAGEM1' => 'max:200',
//        'DI_MENSAGEM1' => 'required|max:200',
        'DI_INSTRUCAO1' => 'max:200',
//        'DI_INSTRUCAO1' => 'required|max:200',
        'DI_INSTRUCAO2' => 'max:200',
        'DI_INSTRUCAO3' => 'max:200',

        'DI_ACEITE' => 'max:20',
        'DI_ESPECIEDOC' => 'max:20',
    ];

}
