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
                    <label for='DEM_ATIVIDADE'>*ATIVIDADE</label>
                    {{ Form::select('DEM_ATIVIDADE', [
                                    'PASTOR' => 'PASTOR', 
                                    'EVANGELISTA' => 'EVANGELISTA', 
                        ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase', 'required'])
                    }}

                    @if ($errors->has('DEM_ATIVIDADE'))
                    <span class='text-danger'> {{ $errors->first('DEM_ATIVIDADE') }} </span>
                    @endif                
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_SITUACAO'>*SITUAÇÃO</label>
                    {{ Form::select('DEM_SITUACAO', [
                                    'ATIVO' => 'ATIVO', 
                                    'JUBILADO' => 'JUBILADO', 
                                    'INATIVO' => 'INATIVO', 
                                    'ARQUIVO MORTO' => 'ARQUIVO MORTO', 
                        ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase', 'required'])
                    }}
                    @if ($errors->has('DEM_SITUACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_SITUACAO') }} </span>
                    @endif
                </div>
                
                <div class='input-field col-md-2'>
                    <label for='DEM_SUPERVISORCAMPO' id='tooltip-hover1' class='btn btn-danger' title='Preencha somente se este ministro for Supervisor de Campo'>
                        <i class=' mdi mdi-alert-circle text-danger'></i> SUPV. DA ÁREA:
                    </label>
                    <select name='DEM_SUPERVISORCAMPO' class="select2 form-control">
                        <option></option>
                        @foreach($areas as $area)
                        <option 
                            @if(isset($data->DEM_SUPERVISORCAMPO) && ($data->DEM_SUPERVISORCAMPO==$area->ARE_CODIGOMANUAL)) @php echo 'selected'; @endphp @endif 
                            value="{{$area->ARE_CODIGOMANUAL}}" >
                            {{$area->ARE_CODIGOMANUAL}} 
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('DEM_SUPERVISORCAMPO'))
                    <span class='text-danger'> {{ $errors->first('DEM_SUPERVISORCAMPO') }} </span>
                    @endif
                </div>
                
                
                <div class='input-field col-md-2'>
                    <label for='DEM_PRESIDENTEDECAMPO' id='tooltip-hover' class='btn btn-danger' title='Preencha somente se este ministro for Presidente de Campo'>
                        <i class=' mdi mdi-alert-circle text-danger'></i> PRES. DO CAMPO:</label>
                    <select name='DEM_PRESIDENTEDECAMPO' class='select2 form-control'>
                        <option></option>
                        @foreach($igrejas as $igreja)
                        <option 
                            @if(isset($data->DEM_PRESIDENTEDECAMPO) && ($data->DEM_PRESIDENTEDECAMPO==$igreja->IGR_MATRICULA)) @php echo 'selected'; @endphp @endif 
                            value="{{$igreja->IGR_MATRICULA}}" >
                            {{$igreja->IGR_MATRICULA}} 
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('DEM_PRESIDENTEDECAMPO'))
                    <span class='text-danger'> {{ $errors->first('DEM_PRESIDENTEDECAMPO') }} </span>
                    @endif
                </div>
                
                <div class='input-field col-md-2'>
                    <label for='DEM_ITINERANTE'>*ITINERANTE?</label>
                    {{ Form::select('DEM_ITINERANTE', [
                                    'NÃO' => 'NÃO', 
                                    'SIM' => 'SIM', 
                        ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase', 'required'])
                    }}
                    @if ($errors->has('DEM_ITINERANTE'))
                    <span class='text-danger'> {{ $errors->first('DEM_ITINERANTE') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_CURSOTEOLOGICO'>*CURSO TEOLÓGICO</label>
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
            </div>
            
            <div class='row manager'>
                <div class='input-field col-md-1'>
                    <label for='DEM_COLETOR'>*COLETOR?</label>
                    {{ Form::select('DEM_COLETOR', [
                                    'NÃO' => 'NÃO', 
                                    'SIM' => 'SIM', 
                                ], null, ['class' => 'form-control', 'required'])
                    }}
                    @if ($errors->has('DEM_COLETOR'))
                    <span class='text-danger'> {{ $errors->first('DEM_COLETOR') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='DEM_MESADIRETORA'>MESA DIRETORA</label>
                    {{ Form::select('DEM_MESADIRETORA', [
                                    '' => '', 
                                    'PRESIDENTE' => 'PRESIDENTE', 
                                    '1º VICE-PRESIDENTE' => '1º VICE-PRESIDENTE', 
                                    '2º VICE-PRESIDENTE' => '2º VICE-PRESIDENTE', 
                                    '3º VICE-PRESIDENTE' => '3º VICE-PRESIDENTE', 
                                    '4º VICE-PRESIDENTE' => '4º VICE-PRESIDENTE', 
                                    '1º SECRETÁRIO' => '1º SECRETÁRIO', 
                                    '2º SECRETÁRIO' => '2º SECRETÁRIO', 
                                    '3º SECRETÁRIO' => '3º SECRETÁRIO', 
                                    '4º SECRETÁRIO' => '4º SECRETÁRIO', 
                                    'SECRETÁRIO ADJUNTO' => 'SECRETÁRIO ADJUNTO', 
                                    'SECRETÁRIO DE EXPEDIENTE' => 'SECRETÁRIO DE EXPEDIENTE', 
                                    '1º TESOUREIRO' => '1º TESOUREIRO', 
                                    '2º TESOUREIRO' => '2º TESOUREIRO', 
                        ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('DEM_MESADIRETORA'))
                    <span class='text-danger'> {{ $errors->first('DEM_MESADIRETORA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='DEM_NOMECONSELHO'>CONSELHO</label>
                    {{ Form::select('DEM_NOMECONSELHO', [
                                    '' => '', 
                                    'CONSELHO DE CAPELANIA' => 'CONSELHO DE CAPELANIA', 
                                    'CONSELHO POLÍTICO' => 'CONSELHO POLÍTICO', 
                                    'CONSELHO DE EXAME DE CONTAS' => 'CONSELHO DE EXAME DE CONTAS', 
                                    'CONSELHO DE EDUCAÇÃO E CULTURA' => 'CONSELHO DE EDUCAÇÃO E CULTURA', 
                                    'CONSELHO DE ÉTICA E DISCIPLINA' => 'CONSELHO DE ÉTICA E DISCIPLINA', 
                                    'CONSELHO ECLESIÁSTICO' => 'CONSELHO ECLESIÁSTICO', 
                                    'COMISSÃO CONSULTIVA' => 'COMISSÃO CONSULTIVA', 
                                    'COMISSÃO JURÍDICA' => 'COMISSÃO JURÍDICA', 
                                    'AGÊNCIA DE MISSÕES' => 'AGÊNCIA DE MISSÕES', 
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
                <div class='input-field col-md-1'>
                    <label for='DEM_FUNCAOCONSELHO'>FUNÇÃO</label>
                    {{ Form::select('DEM_FUNCAOCONSELHO', [
                                    '' => '', 
                                    'PRESIDENTE' => 'PRESIDENTE', 
                                    'SECRETÁRIO' => 'SECRETÁRIO', 
                                    'RELATOR' => 'RELATOR', 
                                    'MEMBRO' => 'MEMBRO', 
                        ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('DEM_FUNCAOCONSELHO'))
                    <span class='text-danger'> {{ $errors->first('DEM_FUNCAOCONSELHO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTFILIACAO'>*DT FILIAÇÃO</label>
                    {!! Form::date('DEM_DTFILIACAO', null, ['class'=>'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('DEM_DTFILIACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTFILIACAO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_APRESENTADOPOR'>*APRESENTADO POR</label>
                    {!! Form::text('DEM_APRESENTADOPOR', null, ['maxlength' => '120', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('DEM_APRESENTADOPOR'))
                    <span class='text-danger'> {{ $errors->first('DEM_APRESENTADOPOR') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTRECEBIDO'>DT. RECEBIDO</label>
                    {!! Form::date('DEM_DTRECEBIDO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTRECEBIDO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTRECEBIDO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='DEM_IGREJADEORIGEM'>IGREJA ORIGEM</label>
                    {!! Form::text('DEM_IGREJADEORIGEM', null, ['maxlength' => '80', 'class' => 'form-control', 'style' => 'text-transform: uppercase' ]) !!}
                    @if ($errors->has('DEM_IGREJADEORIGEM'))
                    <span class='text-danger'> {{ $errors->first('DEM_IGREJADEORIGEM') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-1'>
                    <label for='DEM_NATIVO'>*NATIVO?</label>
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
                    <label for='DEM_REINTEGRADO'>*REINTEGRADO?</label>
                    {{ Form::select('DEM_REINTEGRADO', [
                                    'NÃO' => 'NÃO', 
                                    'SIM' => 'SIM', 
                                ], null, ['class' => 'form-control', 'required'])
                    }}
                    @if ($errors->has('DEM_REINTEGRADO'))
                    <span class='text-danger'> {{ $errors->first('DEM_REINTEGRADO') }} </span>
                    @endif
                </div>
            </div>

            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTCARTAMUDANCA'>DT. CARTA MUDANÇA</label>
                    {!! Form::date('DEM_DTCARTAMUDANCA', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTCARTAMUDANCA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTCARTAMUDANCA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTMUDANCADEAREA'>DT. MUDANÇA ÁREA</label>
                    {!! Form::date('DEM_DTMUDANCADEAREA', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTMUDANCADEAREA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTMUDANCADEAREA') }} </span>
                    @endif
                </div>
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
                    <label for='DEM_DTAUXILIAR'>AUXILIAR DESDE</label>
                    {!! Form::date('DEM_DTAUXILIAR', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTAUXILIAR'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTAUXILIAR') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTDIACONO'>DIÁCONO DESDE</label>
                    {!! Form::date('DEM_DTDIACONO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTDIACONO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTDIACONO') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTPRESBITERO'>PRESBÍTERO DESDE</label>
                    {!! Form::date('DEM_DTPRESBITERO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTPRESBITERO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTPRESBITERO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTEVANGELISTA'>EVANGELISTA DESDE</label>
                    {!! Form::date('DEM_DTEVANGELISTA', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTEVANGELISTA'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTEVANGELISTA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTDIRIGENTE'>DIRIGENTE DESDE</label>
                    {!! Form::date('DEM_DTDIRIGENTE', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTDIRIGENTE'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTDIRIGENTE') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTPASTOR'>PASTOR DESDE</label>
                    {!! Form::date('DEM_DTPASTOR', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTPASTOR'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTPASTOR') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTACLAMACAO'>DT. ACLAMAÇÃO</label>
                    {!! Form::date('DEM_DTACLAMACAO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTACLAMACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTACLAMACAO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEM_DTCONSAGRACAO'>DT. CONSAGRAÇÃO</label>
                    {!! Form::date('DEM_DTCONSAGRACAO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTCONSAGRACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTCONSAGRACAO') }} </span>
                    @endif
                </div>
            </div>
            
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label null='DEM_DTORDENACAO'>DT. ORDENAÇÃO</label>
                    {!! Form::date('DEM_DTORDENACAO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTORDENACAO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTORDENACAO') }} </span>
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
                <div class='input-field col-md-2'>
                    <label for='DEM_DTJUBILADO'>DT. JUBILADO</label>
                    {!! Form::date('DEM_DTJUBILADO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEM_DTJUBILADO'))
                    <span class='text-danger'> {{ $errors->first('DEM_DTJUBILADO') }} </span>
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