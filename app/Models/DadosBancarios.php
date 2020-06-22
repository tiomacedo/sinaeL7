<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class DadosBancarios extends Model  {

    
    use SoftDeletes;

    protected $table = 'dados_bancarios';
    protected $primaryKey = 'BAN_CODIGO';
    protected $fillable = [
        'user_id',
        'BAN_NOME',
        'BAN_AGENCIA',
        'BAN_CONTA',
        'BAN_TIPOCONTA',
        'BAN_VARIACAO',
    ];
    public $rules = [
        'user_id' => 'required|numeric',
        'BAN_NOME' => 'required|min:4|max:50',
        'BAN_AGENCIA' => 'required|max:7',
        'BAN_CONTA' => 'required|max:20',
        'BAN_TIPOCONTA' => 'required|max:20',
        'BAN_VARIACAO' => 'max:5',
    ];

}
