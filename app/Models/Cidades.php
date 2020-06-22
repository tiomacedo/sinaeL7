<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Cidades extends Model  {

    
    use SoftDeletes;

    protected $table = 'cidades';
    protected $primaryKey = 'CID_CODIGO';
    protected $fillable = ['CID_NOME', 'CID_UF'];
    public $rules = [
        'CID_CODIGO' => 'required|numeric',
        'CID_NOME' => 'required|max:120',
        'CID_UF' => 'required|max:2',
    ];

}
