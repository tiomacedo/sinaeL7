@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li><a href='{{url('/restrito/debitos-tipo')}}'>MODALIDADES</a></li>
                        <li class='active'><a href='{{url('/restrito/debitos')}}'>RECEITAS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>DÉBITOS | <small>REGISTRO DE PAGAMENTOS</small></h4>
        </div> 
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->DEB_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/debitos/editar/$data->DEB_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/debitos/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/debitos/cadastrar' ]) !!}
            @endif 

            <div class='row manager'>
                <div class='input-field col-md-3'>
                    <label for='TD_CODIGO'>DESCRIÇÃO</label>
                    <select name='TD_CODIGO' id='DEB_CODIGO' class="select2 form-control">
                        @foreach($tipos as $tipo)
                        <option 
                            @if(isset($data->TD_CODIGO) && ($data->TD_CODIGO==$tipo->TD_CODIGO)) @php echo 'selected'; @endphp @endif 
                            value="{{$tipo->TD_CODIGO}}" >
                            {{$tipo->TD_DESCRICAO}}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('TD_CODIGO'))
                    <span class='text-danger'> {{ $errors->first('TD_CODIGO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='COMPLEMENTO'>COMPLEMENTO</label>
                    {!! Form::text('COMPLEMENTO', null, ['class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                    @if ($errors->has('COMPLEMENTO'))
                    <span class='text-danger'> {{ $errors->first('COMPLEMENTO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEB_DTLANCAMENTO'>LANÇAMENTO</label>
                    {!! Form::date('DEB_DTLANCAMENTO', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('DEB_DTLANCAMENTO'))
                    <span class='text-danger'> {{ $errors->first('DEB_DTLANCAMENTO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEB_DTVENCIMENTO'>VENCIMENTO</label>
                    {!! Form::date('DEB_DTVENCIMENTO', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('DEB_DTVENCIMENTO'))
                    <span class='text-danger'> {{ $errors->first('DEB_DTVENCIMENTO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DEB_DTPAGAMENTO'>PAGAMENTO</label>
                    {!! Form::date('DEB_DTPAGAMENTO', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DEB_DTPAGAMENTO'))
                    <span class='text-danger'> {{ $errors->first('DEB_DTPAGAMENTO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-1'>
                    <label for='DEB_VALOR'>VALOR R$</label>
                    {!! Form::text('DEB_VALOR', null, ['class' => 'form-control autonumber', 'required' => 'yes']) !!}
                    @if ($errors->has('DEB_VALOR'))
                    <span class='text-danger'> {{ $errors->first('DEB_VALOR') }} </span>
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