<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class DadosEclesiaticosMinistros extends Model  {

    
    use SoftDeletes;

    protected $table = 'dados_eclesiaticos_ministros';
    protected $primaryKey = 'DEM_CODIGO';
    protected $fillable = [
        'user_id',
        'DEM_COLETOR',
        'DEM_ATIVIDADE',
        'DEM_SITUACAO',
        'DEM_PRESIDENTEDECAMPO',
        'DEM_SUPERVISORCAMPO',
        'DEM_ITINERANTE',
        'DEM_CURSOTEOLOGICO',
        'DEM_MESADIRETORA',
        'DEM_NOMECONSELHO',
        'DEM_FUNCAOCONSELHO',
        'DEM_DTFILIACAO',
        'DEM_APRESENTADOPOR',
        'DEM_DTRECEBIDO',
        'DEM_IGREJADEORIGEM',
        'DEM_CONVENCAODEORIGEM',
        'DEM_REINTEGRADO',
        'DEM_DTMUDANCA',
        'DEM_DTMUDANCADEAREA',
        'DEM_DTDESLIGAMENTO',
        'DEM_MOTIVODESLIGAMENTO',
        'DEM_DTBATISMOAGUA',
        'DEM_DTBATISMOESPIRITO',
        'DEM_DTCONSAGRACAO',
        'DEM_DTORDENACAO',
        'DEM_DTJUBILADO',
        'DEM_OBSERVACAO',
        'DEM_DTAUXILIAR',
        'DEM_DTDIACONO',
        'DEM_DTPRESBITERO',
        'DEM_DTEVANGELISTA',
        'DEM_DTPASTOR',
        'DEM_DTDIRIGENTE',
        'DEM_DTCONVERSAO',
        'DEM_DTACLAMACAO',
        'DEM_DTCONGREGADODESDE',
        'DEM_NATIVO',
        'DEM_DEPARTAMENTOIGREJA',
        'DEM_DTDEPARTAMENTOIGREJA',
        'DEM_FUNCAODEPARTAMENTOIGREJA',
    ];
    public $rules = [
        'user_id' => 'required|numeric',
        'DEM_COLETOR' => 'required|max:3',
        'DEM_ATIVIDADE' => 'required|max:30',
        'DEM_SITUACAO' => 'required|max:30',
        'DEM_PRESIDENTEDECAMPO' => 'max:10',
        'DEM_SUPERVISORCAMPO' => 'max:10',
        'DEM_ITINERANTE' => 'required|max:3',
        'DEM_CURSOTEOLOGICO' => 'required|min:4|max:20',
        'DEM_MESADIRETORA' => 'max:80',
        'DEM_NOMECONSELHO' => 'max:80',
        'DEM_FUNCAOCONSELHO' => 'max:80',
        'DEM_DTFILIACAO' => 'required|date',
        'DEM_APRESENTADOPOR' => 'required|max:120',
        'DEM_DTRECEBIDO' => 'date',
        'DEM_IGREJADEORIGEM' => 'max:80',
        'DEM_CONVENCAODEORIGEM' => 'max:80',
        'DEM_REINTEGRADO' => 'max:3',
        'DEM_DTMUDANCA' => 'date',
        'DEM_DTMUDANCADEAREA' => 'date',
        'DEM_DTDESLIGAMENTO' => 'date',
        'DEM_MOTIVODESLIGAMENTO' => 'max:120',
        'DEM_DTBATISMOAGUA' => 'date',
        'DEM_DTBATISMOESPIRITO' => 'date',
        'DEM_DTCONSAGRACAO' => 'date',
        'DEM_DTORDENACAO' => 'date',
        'DEM_DTJUBILADO' => 'date',
        'DEM_OBSERVACAO' => 'max:500',
        'DEM_DTAUXILIAR' => 'date',
        'DEM_DTDIACONO' => 'date',
        'DEM_DTPRESBITERO' => 'date',
        'DEM_DTEVANGELISTA' => 'date',
        'DEM_DTPASTOR' => 'date',
        'DEM_DTDIRIGENTE' => 'date',
        'DEM_DTCONVERSAO' => 'date',
        'DEM_DTCARTAMUDANCA' => 'date',
        'DEM_DTACLAMACAO' => 'date',
        'DEM_DTCONGREGADODESDE' => 'date',
        'DEM_NATIVO' => 'max:3',
        'DEM_DEPARTAMENTOIGREJA' => 'max:60',
        'DEM_DTDEPARTAMENTOIGREJA' => 'date',
        'DEM_FUNCAODEPARTAMENTOIGREJA' => 'max:60',
    ];

}
