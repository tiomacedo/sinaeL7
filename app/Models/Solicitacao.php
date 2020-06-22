<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Solicitacao extends Model  {

    
    use SoftDeletes;

    protected $table = 'solicitacoes';
    protected $primaryKey = 'SOL_CODIGO';
    protected $fillable = ['user_id', 'SOL_PEDIDO', 'SOL_STATUS', 'SOL_RESPOSTA', 'SOL_CHECK'];
    public $rules = [
        'user_id' => 'numeric|required',
        'SOL_PEDIDO' => 'required',
        'SOL_STATUS' => 'required|max:25',
        'SOL_CHECK' => 'max:1',
        'SOL_RESPOSTA' => '',
    ];

}