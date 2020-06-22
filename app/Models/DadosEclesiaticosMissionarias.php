<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class DadosEclesiaticosMissionarias extends Model  {

    
    use SoftDeletes;

    protected $table = 'dados_eclesiaticos_missionarias';
    protected $primaryKey = 'DEM_CODIGO';
    protected $fillable = [
        'user_id',
        'DEM_ATIVIDADE',
        'DEM_SITUACAO',
        'DEM_CURSOTEOLOGICO',
        'DEM_NOMECONSELHO',
        'DEM_FUNCAOCONSELHO',
        'DEM_DTFILIACAO',
        'DEM_DTRECEBIDO',
        'DEM_IGREJADEORIGEM',
        'DEM_NATIVO',
        'DEM_CONVENCAODEORIGEM',
        'DEM_DTMUDANCA',
        'DEM_REINTEGRADO',
        'DEM_DTCONVERSAO',
        'DEM_DTCONGREGADODESDE',
        'DEM_DTBATISMOAGUA',
        'DEM_DTBATISMOESPIRITO',
        'DEM_DTDESLIGAMENTO',
        'DEM_MOTIVODESLIGAMENTO',
        'DEM_DEPARTAMENTOIGREJA',
        'DEM_DTDEPARTAMENTOIGREJA',
        'DEM_FUNCAODEPARTAMENTOIGREJA',
        'DEM_OBSERVACAO',
    ];
    public $rules = [
        'user_id' => 'required|numeric',
        'DEM_ATIVIDADE' => 'required|max:30',
        'DEM_SITUACAO' => 'required|max:30',
        'DEM_CURSOTEOLOGICO' => 'required|min:4|max:20',
        'DEM_NOMECONSELHO' => 'max:80',
        'DEM_FUNCAOCONSELHO' => 'max:80',
        'DEM_DTFILIACAO' => 'required|date',
        'DEM_DTRECEBIDO' => 'required|date',
        'DEM_IGREJADEORIGEM' => 'max:80',
        'DEM_NATIVO' => 'max:3',
        'DEM_CONVENCAODEORIGEM' => 'max:80',
        'DEM_DTMUDANCA' => 'date',
        'DEM_REINTEGRADO' => 'max:3',
        'DEM_DTCONVERSAO' => 'date',
        'DEM_DTCONGREGADODESDE' => 'date',
        'DEM_DTBATISMOAGUA' => 'date',
        'DEM_DTBATISMOESPIRITO' => 'date',
        'DEM_DTDESLIGAMENTO' => 'date',
        'DEM_MOTIVODESLIGAMENTO' => 'max:120',
        'DEM_DEPARTAMENTOIGREJA' => 'max:60',
        'DEM_DTDEPARTAMENTOIGREJA' => 'date',
        'DEM_FUNCAODEPARTAMENTOIGREJA' => 'max:60',
        'DEM_OBSERVACAO' => 'max:500',
    ];

}
