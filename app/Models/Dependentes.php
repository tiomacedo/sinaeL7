<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Dependentes extends Model  {

    
    use SoftDeletes;

    protected $table = 'dependentes';
    protected $primaryKey = 'DEP_CODIGO';
    protected $fillable = [
        'user_id',
        'DEP_NOME',
        'DEP_GRAUPARENTESCO',
        'DEP_DATANASCIMENTO',
    ];
    public $rules = [
        'user_id' => 'required|numeric',
        'DEP_NOME' => 'required|max:120',
        'DEP_GRAUPARENTESCO' => 'required|max:40',
        'DEP_DATANASCIMENTO' => 'required|date',
    ];

}
