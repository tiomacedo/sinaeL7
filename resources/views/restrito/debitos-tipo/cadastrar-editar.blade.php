@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li> <a href='{{url('/restrito/debitos-tipo')}}'>MODALIDADES</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>MODALIDADE DOS DÉBITOS | <small>GERENCIAMENTO DOS REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->TD_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/debitos-tipo/editar/$data->TD_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/debitos-tipo/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/debitos-tipo/cadastrar' ]) !!}
            @endif 
            <div class='row manager'>
                <div class='input-field col-md-12'>
                    <label for='TD_DESCRICAO'>DESCRIÇÃO</label>
                    {!! Form::text('TD_DESCRICAO', null, ['min' => '5', 'maxlength' => '70', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('TD_DESCRICAO'))
                    <span class='text-danger'> {{ $errors->first('TD_DESCRICAO') }} </span>
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