<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Endereco extends Model  {

    
    use SoftDeletes;

    protected $table = 'enderecos';
    protected $primaryKey = 'END_CODIGO';
    protected $fillable = [
        'CID_CODIGO',
        'END_CEP',
        'END_LOGRADOURO',
        'END_TIPOLOGRADOURO',
        'END_BAIRRO',
        'END_COMPLEMENTO',
        'END_NUMERO',
        'END_DESCRICAOERRO',
    ];
    public $rules = [
        'CID_CODIGO' => 'required|numeric',
        'END_CEP' => 'max:10',
        'END_LOGRADOURO' => 'max:100',
        'END_TIPOLOGRADOURO' => 'max:20',
        'END_BAIRRO' => 'max:50',
        'END_COMPLEMENTO' => 'max:20',
        'END_NUMERO' => 'max:7',
        'END_DESCRICAOERRO' => 'max:200',
    ];

}
