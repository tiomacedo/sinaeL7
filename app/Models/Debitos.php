<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Debitos extends Model  {

    
    use SoftDeletes;

    protected $table = 'debitos';
    protected $primaryKey = 'DEB_CODIGO';
    protected $fillable = ['TD_CODIGO', 'DEB_DTLANCAMENTO', 'DEB_DTVENCIMENTO', 'DEB_DTPAGAMENTO', 'DEB_VALOR', 'COMPLEMENTO']; //ESPECIFICO EM QUAIS CAMPOS PODEM SER GRAVADOS
    public $rules = [
        'TD_CODIGO' => 'required|numeric',
        'DEB_DTLANCAMENTO' => 'required|date',
        'DEB_DTVENCIMENTO' => 'required|date',
        'DEB_DTPAGAMENTO' => 'date',
        'DEB_VALOR' => 'required',
        'COMPLEMENTO' => 'max:200',
    ];

}
