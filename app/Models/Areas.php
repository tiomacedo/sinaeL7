<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Areas extends Model 
{
    
    use SoftDeletes;

    protected $table = 'areas';
    protected $primaryKey = 'ARE_CODIGO';
    protected $fillable = ['ARE_DESCRICAO', 'ARE_CODIGOMANUAL']; //ESPECIFICO EM QUAIS CAMPOS PODEM SER GRAVADOS
    public $rules = [
        'ARE_CODIGOMANUAL' => 'required|max:10|unique:areas,ARE_CODIGOMANUAL,((ID{?})),ARE_CODIGO',
        'ARE_DESCRICAO' => 'required|max:500',
    ];
    
    public function igrejas(){
        return $this->hasMany('App\Models\Igrejas','ARE_CODIGO');
    }

}
