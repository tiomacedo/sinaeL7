@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'> <a href='{{url('/restrito/patrimonios')}}'>PATRIMÔNIOS</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>PATRIMÔNIOS | <small>GERENCIAMENTO DOS REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->PAT_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/patrimonios/editar/$data->PAT_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/patrimonios/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/patrimonios/cadastrar' ]) !!}
            @endif 

            <div class='row manager'>
                <div class='input-field col-md-6'>
                    <label for='PAT_TIPO'>DESCRIÇÃO</label>
                    {!! Form::text('PAT_TIPO', null, ['min' => '5', 'maxlength' => '70', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('PAT_TIPO'))
                    <span class='text-danger'> {{ $errors->first('PAT_TIPO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-4'>
                    <label for='PAT_MARCA'>MARCA</label>
                    {!! Form::text('PAT_MARCA', null, ['min' => '5', 'maxlength' => '70', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('PAT_MARCA'))
                    <span class='text-danger'> {{ $errors->first('PAT_MARCA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='PAT_VALOR'>VALOR R$</label>
                    {!! Form::text('PAT_VALOR', null, ['class' => 'form-control autonumber', 'required' => 'yes']) !!}
                    @if ($errors->has('PAT_VALOR'))
                    <span class='text-danger'> {{ $errors->first('PAT_VALOR') }} </span>
                    @endif
                </div>
            </div>
            <div class='row'>
                <div class='input-field col-md-3'>
                    <label for='PAT_DATAAQUISICAO'>DATA AQUISIÇÃO</label>
                    {!! Form::date('PAT_DATAAQUISICAO', \Carbon\Carbon::now(), ['class'=>'form-control', 'requiried']) !!}
                    @if ($errors->has('PAT_DATAAQUISICAO'))
                    <span class='text-danger'> {{ $errors->first('PAT_DATAAQUISICAO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='PAT_ANOSUTEIS'>VIDA ÚTIL</label>
                    {!! Form::number('PAT_ANOSUTEIS', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('PAT_ANOSUTEIS'))
                    <span class='text-danger'> {{ $errors->first('PAT_ANOSUTEIS') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='PAT_ESTADO'>ESTADO</label>
                    {!! Form::select('PAT_ESTADO', [
                                        'NOVO' => 'NOVO', 
                                        'SEMINOVO' => 'SEMINOVO', 
                            ], null, ['class' => 'form-control'])
                    !!}
                    @if ($errors->has('PAT_ESTADO'))
                    <span class='text-danger'> {{ $errors->first('PAT_ESTADO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='PAT_LOCALIZACAO'>LOCALIZAÇÃO</label>
                    {!! Form::select('PAT_LOCALIZACAO', [
                                        'SEDE CIMADSETA' => 'SEDE CIMADSETA', 
                                        'EMPRESTADO' => 'EMPRESTADO', 
                                        'EXTRAVIADO' => 'EXTRAVIADO', 
                            ], null, ['class' => 'form-control'])
                    !!}
                    @if ($errors->has('PAT_LOCALIZACAO'))
                    <span class='text-danger'> {{ $errors->first('PAT_LOCALIZACAO') }} </span>
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