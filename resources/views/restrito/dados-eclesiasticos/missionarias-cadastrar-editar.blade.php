@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active text-uppercase'><a href='{{url("/restrito/$tipo")}}'>{{$tipo}}</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>DADOS ECLESIÁSTICOS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->DEM_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/$tipo/dados-eclesiasticos/editar/$data->DEM_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => "/restrito/$tipo/dados-eclesiasticos/cadastrar/{$id}", 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/dados-eclesiasticoss/cadastrar' ]) !!}
            @endif 

            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DEM_SITUACAO'>SITUAÇÃO</label>
                    {{ Form::select('DEM_SITUACAO', [
                                    'ATIVA' => 'ATIVA', 
                                    'INATIVA' => 'INATIVA', 
                        ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase', 'required'])
                    }}
                    @if ($errors->has('DEM_SITUACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_SITUACAO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_CURSOTEOLOGICO'>CURSO TEOLÓGICO</label>
                    {{ Form::select('DEM_CURSOTEOLOGICO', [
                                    'BÁSICO' => 'BÁSICO', 
                                    'MÉDIO' => 'MÉDIO', 
                                    'SUPERIOR' => 'SUPERIOR', 
                        ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' ])
                    }}
                    @if ($errors->has('DEM_CURSOTEOLOGICO'))
                    <span class='text-danger'> {{ $errors->first('DEM_CURSOTEOLOGICO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_NOMECONSELHO'>ÓRGÃOS</label>
                    {{ Form::select('DEM_NOMECONSELHO', [
                                    '' => '', 
                                    'UEMADS' => 'UEMADS', 
                                    'UNIFILHOS' => 'UNIFILHOS', 
                                    'UNIKIDS' => 'UNIKIDS', 
                                    'UMADSETA' => 'UMADSETA', 
                                    'AGEMADSETA' => 'AGEMADSETA', 
                        ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('DEM_NOMECONSELHO'))
                    <span class='text-danger'> {{ $errors->first('DEM_NOMECONSELHO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_FUNCAOCONSELHO'>FUNÇÃO</label>
                    {{ Form::select('DEM_FUNCAOCONSELHO', [
                                    '' => '', 
                                    'PRESIDENTE' => 'PRESIDENTE', 
                                    'SECRETÁRIA' => 'SECRETÁRIA', 
                                    'RELATORA' => 'RELATORA', 
                                    'MEMBRO' => 'MEMBRO', 
                        ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('DEM_FUNCAOCONSELHO'))
                    <span class='text-danger'> {{ $errors->first('DEM_FUNCAOCONSELHO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTFILIACAO'>DT FILIAÇÃO</label>
                    {!! Form::date('DEM_DTFILIACAO', null, ['class'=>'form-control', 'required']) !!}
                    @if ($errors->has('DEM_DTFILIACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTFILIACAO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTRECEBIDO'>DT. RECEBIDO</label>
                    {!! Form::date('DEM_DTRECEBIDO', null, ['class'=>'form-control', 'required']) !!}
                    @if ($errors->has('DEM_DTRECEBIDO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTRECEBIDO') }} </span>
                    @endif     
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-3'>
                    <label for='DEM_IGREJADEORIGEM'>IGREJA ORIGEM</label>
                    {!! Form::text('DEM_IGREJADEORIGEM', null, ['maxlength' => '80', 'class' => 'form-control', 'style' => 'text-transform: uppercase' ]) !!}
                    @if ($errors->has('DEM_IGREJADEORIGEM'))
                    <span class='text-danger'> {{ $errors->first('DEM_IGREJADEORIGEM') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-1'>
                    <label for='DEM_NATIVO'>NATIVO?</label>
                    {{ Form::select('DEM_NATIVO', [
                                    'SIM' => 'SIM', 
                                    'NÃO' => 'NÃO', 
                        ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase', 'required'])
                    }}
                    @if ($errors->has('DEM_NATIVO'))
                    <span class='text-danger'> {{ $errors->first('DEM_NATIVO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-3'>
                    <label for='DEM_CONVENCAODEORIGEM'>CONVENÇÃO ORIGEM</label>
                    {!! Form::text('DEM_CONVENCAODEORIGEM', null, ['maxlength' => '80', 'class' => 'form-control', 'style' => 'text-transform: uppercase' ]) !!}
                    @if ($errors->has('DEM_CONVENCAODEORIGEM'))
                    <span class='text-danger'> {{ $errors->first('DEM_CONVENCAODEORIGEM') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTMUDANCA'>DT. MUDANÇA</label>
                    {!! Form::date('DEM_DTMUDANCA', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTMUDANCA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTMUDANCA') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-1'>
                    <label for='DEM_REINTEGRADO'>REINTEGRADO?</label>
                    {{ Form::select('DEM_REINTEGRADO', [
                                    'NÃO' => 'NÃO', 
                                    'SIM' => 'SIM', 
                                ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('DEM_REINTEGRADO'))
                    <span class='text-danger'> {{ $errors->first('DEM_REINTEGRADO') }} </span>
                    @endif     
                </div>
            </div>

            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTCONVERSAO'>DT. CONVERSÃO</label>
                    {!! Form::date('DEM_DTCONVERSAO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTCONVERSAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTCONVERSAO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTCONGREGADODESDE'>CONGREGADO DESDE</label>
                    {!! Form::date('DEM_DTCONGREGADODESDE', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTCONGREGADODESDE'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTCONGREGADODESDE') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTBATISMOAGUA'>DT. BATISMO</label>
                    {!! Form::date('DEM_DTBATISMOAGUA', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTBATISMOAGUA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTBATISMOAGUA') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTBATISMOESPIRITO'>BATISMO E. S.</label>
                    {!! Form::date('DEM_DTBATISMOESPIRITO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTBATISMOESPIRITO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTBATISMOESPIRITO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTDESLIGAMENTO'>DT. DESLIGAMENTO</label>
                    {!! Form::date('DEM_DTDESLIGAMENTO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTDESLIGAMENTO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTDESLIGAMENTO') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_MOTIVODESLIGAMENTO'>MOTIVO</label>
                    {{ Form::select('DEM_MOTIVODESLIGAMENTO', [
                                    '' => '', 
                                    'MUDANÇA' => 'MUDANÇA', 
                                    'FALECIMENTO' => 'FALECIMENTO', 
                                    'DESCREDENCIAMENTO' => 'DESCREDENCIAMENTO', 
                        ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('DEM_MOTIVODESLIGAMENTO'))
                    <span class='text-danger'> {{ $errors->first('DEM_MOTIVODESLIGAMENTO') }} </span>
                    @endif     
                </div>
            </div>
            <div class='row'>    
                <div class='input-field col-md-3'>
                    <label for='DEM_DEPARTAMENTOIGREJA'>DEP. IGREJA</label>
                    {{ Form::select('DEM_DEPARTAMENTOIGREJA', [
                                    '' => '', 
                                    'DEP. INFANTIL' => 'DEP. INFANTIL', 
                                    'DEP. ADOLESCENTES' => 'DEP. ADOLESCENTES', 
                                    'DEP. JOVENS' => 'DEP. JOVENS', 
                                    'DEP. MULHERES/CIRC. ORAÇÃO' => 'DEP. MULHERES/CIRC. ORAÇÃO', 
                                    'DEP. VARÕES' => 'DEP. VARÕES', 
                                    'DEP. MISSÕES' => 'DEP. MISSÕES', 
                                    'DEP. FAMÍLIA' => 'DEP. FAMÍLIA', 
                                    'DEP. AÇÃO SOCIAL' => 'DEP. AÇÃO SOCIAL', 
                                    'DEP. MÚSICA/SOM' => 'DEP. MÚSICA/SOM', 
                                    'DEP. EVENTOS' => 'DEP. EVENTOS', 
                                    'DEP. CASA DO OLEIRO' => 'DEP. CASA DO OLEIRO', 
                                    ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase'])
                    }}
                    @if ($errors->has('DEM_DEPARTAMENTOIGREJA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DEPARTAMENTOIGREJA') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTDEPARTAMENTOIGREJA'>DESDE</label>
                    {!! Form::date('DEM_DTDEPARTAMENTOIGREJA', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTDEPARTAMENTOIGREJA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTDEPARTAMENTOIGREJA') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_FUNCAODEPARTAMENTOIGREJA'>FUNC IGREJA</label>
                    {{ Form::select('DEM_FUNCAODEPARTAMENTOIGREJA', [
                                    '' => '', 
                                    'LÍDER' => 'LÍDER', 
                                    'VICE-LÍDER' => 'VICE-LÍDER', 
                                    'MEMBRO' => 'MEMBRO', 
                                    ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase'])
                    }}
                    @if ($errors->has('DEM_FUNCAODEPARTAMENTOIGREJA'))
                    <span class='text-danger'> {{ $errors->first('DEM_FUNCAODEPARTAMENTOIGREJA') }} </span>
                    @endif     
                </div>
                <div class='input-field col-md-5'>
                    <label for='DEM_OBSERVACAO'>OBSERVAÇÃO</label>
                    {!! Form::text('DEM_OBSERVACAO', null, ['maxlength' => '500', 'class' => 'form-control', 'style' => 'text-transform: uppercase' ]) !!}
                    @if ($errors->has('DEM_OBSERVACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_OBSERVACAO') }} </span>
                    @endif     
                </div>
            </div>
            <div class='modal-footer'>
                <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
                <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection