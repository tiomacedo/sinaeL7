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
            <h4 class='page-title'>DADOS BANCÁRIOS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->BAN_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/$tipo/dados-bancarios/editar/$data->BAN_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => "/restrito/$tipo/dados-bancarios/cadastrar/{$id}", 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/dados-bancarioss/cadastrar' ]) !!}
            @endif 

            <div class='row manager'>
                <div class='input-field col-md-3'>
                    <label for='BAN_NOME'>NOME DO BANCO</label>
                    {{ Form::select('BAN_NOME', [
                                'BANCO DO BRASIL' => 'BANCO DO BRASIL',
                                'CAIXA ECONÔMICA' => 'CAIXA ECONÔMICA',
                                'BRADESCO' => 'BRADESCO',
                                'HSBC' => 'HSBC',
                                'ITAÚ' => 'ITAÚ',
                                'BANCO DA AMAZÔNIA' => 'BANCO DA AMAZÔNIA',
                                'SANTANDER' => 'SANTANDER',
                                'PANAMERICANO' => 'PANAMERICANO',
                                'BNDES' => 'BNDES',
                                'SAFRA' => 'SAFRA',
                                'VOTARANTIM' => 'VOTARANTIM',
                                'BANRISUL' => 'BANRISUL',
                                ], null, ['id'=>'BAN_NOME','class' => 'form-control', 'required' => 'yes'])
                    }}
                    @if ($errors->has('BAN_NOME'))
                    <span class='text-danger'> {{ $errors->first('BAN_NOME') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-2'>
                    <label for='BAN_AGENCIA'>AGÊNCIA</label>
                    {!! Form::text('BAN_AGENCIA', null, ['maxlength' => '7', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('BAN_AGENCIA'))
                    <span class='text-danger'> {{ $errors->first('BAN_AGENCIA') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-3'>
                    <label for='BAN_TIPOCONTA'>TIPO DE CONTA</label>
                    {{ Form::select('BAN_TIPOCONTA', [
                                        'CORRENTE' => 'CORRENTE', 
                                        'POUPANÇA' => 'POUPANÇA', 
                            ], null, ['class' => 'form-control', 'style' => 'text-transform: uppercase'])
                    }}
                    @if ($errors->has('BAN_TIPOCONTA'))
                    <span class='text-danger'> {{ $errors->first('BAN_TIPOCONTA') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-2'>
                    <label for='BAN_CONTA'>CONTA</label>
                    {!! Form::text('BAN_CONTA', null, ['maxlength' => '20', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('BAN_CONTA'))
                    <span class='text-danger'> {{ $errors->first('BAN_CONTA') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-2'>
                    <label for='BAN_VARIACAO'>VARIAÇÃO</label>
                    {!! Form::text('BAN_VARIACAO', null, ['maxlength' => '5', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                    @if ($errors->has('BAN_VARIACAO'))
                    <span class='text-danger'> {{ $errors->first('BAN_VARIACAO') }} </span>
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