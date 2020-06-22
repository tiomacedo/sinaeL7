<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Eventos extends Model  {

    
    use SoftDeletes;

    protected $table = 'eventos';
    protected $primaryKey = 'EVEN_CODIGO';
    protected $fillable = ['EVEN_TITULO', 'EVEN_TEXTO', 'EVEN_DTINICIO', 'EVEN_DTFINAL', 'EVEN_LOCAL', 'EVEN_TIPO']; //ESPECIFICO EM QUAIS CAMPOS PODEM SER GRAVADOS
    public $rules = [
        'EVEN_TITULO' => 'required|max:80',
        'EVEN_TEXTO' => 'required',
        'EVEN_TIPO' => 'required|max:30',
        'EVEN_DTINICIO' => 'required|date',
        'EVEN_DTFINAL' => 'required|date',
        'EVEN_LOCAL' => 'required|max:120',
    ];

}
