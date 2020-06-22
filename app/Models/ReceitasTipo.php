<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class ReceitasTipo extends Model  {

    
    use SoftDeletes;

    protected $table = 'tipos_receitas';
    protected $primaryKey = 'TR_CODIGO';
    protected $fillable = ['TR_DESCRICAO'];
    public $rules = [
        'TR_DESCRICAO' => 'required|min:5|max:120',
    ];

    public function viewReceita() {
        return $this->hasMany('App\Models\Receitas', 'TR_CODIGO')->where('REC_DTRECEBIMENTO', '<>', NULL);
    }

}
