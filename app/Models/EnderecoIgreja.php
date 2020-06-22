<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class EnderecoIgreja extends Model  {

    
    use SoftDeletes;

    protected $table = 'enderecos_igrejas';
    protected $primaryKey = 'ENDIGR_CODIGO';
    protected $fillable = ['IGR_CODIGO', 'END_CODIGO',];
    public $rules = [
        'END_CODIGO' => 'required|numeric',
        'IGR_CODIGO' => 'required|numeric',
    ];

}
