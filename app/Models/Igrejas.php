<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Igrejas extends Model  {

    
    use SoftDeletes;

    protected $table = 'igrejas';
    protected $primaryKey = 'IGR_CODIGO';
    protected $fillable = ['ARE_CODIGO',
        'IGR_MATRICULA',
        'IGR_RESPONSAVEL',
        'IGR_FONE',
        'IGR_CELULAR',
        'IGR_NOMECONGRECACAO',
        'IGR_CNPJ',
        'IGR_TEMPLO',
        'IGR_QTDMISSIONARIOS',
        'IGR_QTDDIACONOS',
        'IGR_QTDPRESBITEROS',
        'IGR_QTDEVANGELISTAS',
        'IGR_QTDPASTORES',
        'IGR_QTDMEMBROS',
        'IGR_QTDELEITORESCIDADE',
        'IGR_QTDELEITORESIGREJA',
        'IGR_QTDMEMBROSPOLITICOS',
        'IGR_QTDFUNCIONARIOSPUBLICOS',
    ]; 
    public $rules = [
        'ARE_CODIGO' => 'required|numeric',
        'IGR_MATRICULA' => 'required',
        'IGR_RESPONSAVEL' => 'required|max:120',
        'IGR_FONE' => 'max:14',
        'IGR_CELULAR' => 'max:14',
        'IGR_NOMECONGRECACAO' => 'required|max:60',
        'IGR_CNPJ' => 'required|min:10|max:18',
        'IGR_TEMPLO' => 'required|min:4|max:20',
        'IGR_QTDMISSIONARIOS' => 'numeric|required',
        'IGR_QTDDIACONOS' => 'numeric|required',
        'IGR_QTDPRESBITEROS' => 'numeric|required',
        'IGR_QTDEVANGELISTAS' => 'numeric|required',
        'IGR_QTDPASTORES' => 'numeric|required',
        'IGR_QTDMEMBROS' => 'numeric|required',
        'IGR_QTDELEITORESCIDADE' => 'numeric|required',
        'IGR_QTDELEITORESIGREJA' => 'numeric|required',
        'IGR_QTDMEMBROSPOLITICOS' => 'numeric|required',
        'IGR_QTDFUNCIONARIOSPUBLICOS' => 'numeric|required',
    ];

    public function areas() {
        return $this->belongsTo('App\Models\Areas', 'ARE_CODIGO');
    }

    public function usuarios() {
        return $this->hasMany('App\Models\User', 'IGR_CODIGO');
    }

}
