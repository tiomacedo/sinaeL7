@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/areas')}}'>ÁREAS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>ÁREAS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->ARE_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/areas/editar/$data->ARE_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/areas/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/areas/cadastrar' ]) !!}
            @endif 


            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='ARE_CODIGOMANUAL'>CÓD ÁREA</label>
                    {!! Form::text('ARE_CODIGOMANUAL', null, ['data-mask' => '99-99', 'required' => 'yes', 'min' => '5', 'maxlength' => '5', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('ARE_CODIGOMANUAL'))
                    <span class='text-danger'> {{ $errors->first('ARE_CODIGOMANUAL') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-10'>
                    <label for='ARE_DESCRICAO'>DESCRIÇÃO</label>
                    {!! Form::text('ARE_DESCRICAO', null, ['required' => 'yes', 
                    'maxlength' => '255', 'style' => 'text-transform: uppercase', 'class' => 'form-control' ]) !!}
                    @if ($errors->has('ARE_DESCRICAO'))
                    <span class='text-danger'> {{ $errors->first('ARE_DESCRICAO') }} </span>
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