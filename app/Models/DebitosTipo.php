<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class DebitosTipo extends Model  {

    
    use SoftDeletes;

    protected $table = 'tipos_debitos';
    protected $primaryKey = 'TD_CODIGO';
    protected $fillable = ['TD_DESCRICAO']; 
    public $rules = [
        'TD_DESCRICAO' => 'required|min:5|max:120',
    ];

}
