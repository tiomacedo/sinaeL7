<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Receitas extends Model  {

    
    use SoftDeletes;

    protected $table = 'receitas';
    protected $primaryKey = 'REC_CODIGO';
    protected $fillable = ['user_id', 'TR_CODIGO', 'REC_DTLANCAMENTO', 'REC_DTREFERENCIA', 'REC_DTVENCIMENTO', 'REC_DTRECEBIMENTO',
        'REC_VALOR', 'COMPLEMENTO', 'REC_VALORRECEBIDO', 'REC_NOSSONUMERO', 'REC_NUMERODOCUMENTO', 'REC_STATUS', 'REC_COLETOR', 'REC_COMPROVANTE']; //ESPECIFICO EM QUAIS CAMPOS PODEM SER GRAVADOS
    public $rules = [
        'user_id' => 'numeric',
        'TR_CODIGO' => 'required|numeric',
        'REC_DTLANCAMENTO' => 'required|date',
        'REC_DTREFERENCIA' => 'date',
        'REC_DTVENCIMENTO' => 'date',
        'REC_DTRECEBIMENTO' => 'date',
        'REC_VALOR' => 'required',
        'REC_VALORRECEBIDO' => '',
        'REC_NOSSONUMERO' => 'max:25|unique:receitas,REC_NOSSONUMERO,((ID{?})),REC_NOSSONUMERO',
        'REC_NUMERODOCUMENTO' => 'max:20|unique:receitas,REC_NUMERODOCUMENTO,((ID{?})),REC_NUMERODOCUMENTO',
        'COMPLEMENTO' => 'max:200',
        'REC_STATUS' => 'max:50',
        'REC_COMPROVANTE' => 'max:120',
    ];

    public function viewTipoReceita() {
        return $this->belongsTo('App\Models\ReceitasTipo', 'TR_CODIGO');
        //return $this->belongsToMany(\App\Models\Permission::class);
    }

}
