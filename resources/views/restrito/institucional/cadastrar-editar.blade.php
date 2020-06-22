@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/institucional')}}'>DADOS INSTITUCIONAIS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>DADOS INSTITUCIONAIS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->DI_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/institucional/editar/$data->DI_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/institucional/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/institucional/cadastrar' ]) !!}
            @endif 

            <div class='row manager'>
                <div class='input-field col-md-3'>
                    <label for='DI_NOMEFANTASIA'>NOME FANTASIA</label>
                    {!! Form::text('DI_NOMEFANTASIA', null, ['required' => 'yes', 'maxlength' => '120', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_NOMEFANTASIA'))
                    <span class='text-danger'> {{ $errors->first('DI_NOMEFANTASIA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='DI_RAZAOSOCIAL'>RAZÃO SOCIAL</label>
                    {!! Form::text('DI_RAZAOSOCIAL', null, ['required' => 'yes', 'maxlength' => '120', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_RAZAOSOCIAL'))
                    <span class='text-danger'> {{ $errors->first('DI_RAZAOSOCIAL') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_MENSALIDADE'>VLR. MENSALIDADE</label>
                    {!! Form::text('DI_MENSALIDADE', null, ['class' => 'form-control form-control autonumber']) !!}
                    @if ($errors->has('DI_MENSALIDADE'))
                    <span class='text-danger'> {{ $errors->first('DI_MENSALIDADE') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_INSCRICAOESTADUAL'>INSC. EST</label>
                    {!! Form::number('DI_INSCRICAOESTADUAL', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_INSCRICAOESTADUAL'))
                    <span class='text-danger'> {{ $errors->first('DI_INSCRICAOESTADUAL') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_CNPJ'>CNPJ</label>
                    {!! Form::text('DI_CNPJ', null, ['data-mask' => '99.999.999/9999-99', 'required' => 'yes', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_CNPJ'))
                    <span class='text-danger'> {{ $errors->first('DI_CNPJ') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-4'>
                    <label for='DI_ENDERECO'>ENDEREÇO</label>
                    {!! Form::text('DI_ENDERECO', null, ['required' => 'yes', 'maxlength' => '120', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_ENDERECO'))
                    <span class='text-danger'> {{ $errors->first('DI_ENDERECO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='DI_CIDADE'>CIDADE</label>
                    {!! Form::text('DI_CIDADE', null, ['required' => 'yes', 'maxlength' => '120', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_CIDADE'))
                    <span class='text-danger'> {{ $errors->first('DI_CIDADE') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-1'>
                    <label for='DI_UF'>UF</label>
                    {!! Form::text('DI_UF', null, ['required' => 'yes', 'maxlength' => '2', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_CIDADE'))
                    <span class='text-danger'> {{ $errors->first('DI_UF') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_CEP'>CEP</label>
                    {!! Form::text('DI_CEP', null, ['data-mask' => '99999-999', 'required' => 'yes', 'maxlength' => '10', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_CEP'))
                    <span class='text-danger'> {{ $errors->first('DI_CEP') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_FONE'>FONE</label>
                    {!! Form::text('DI_FONE', null, ['data-mask' => '(99)9999-9999', 'required' => 'yes', 'maxlength' => '15', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                    @if ($errors->has('DI_FONE'))
                    <span class='text-danger'> {{ $errors->first('DI_FONE') }} </span>
                    @endif
                </div>
            </div>
            <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="mdi mdi-information"></i>
                <strong>A PARTIR DAQUI, O PREENCHIMENTO SÓ É NECESSÁRIO QUANDO SE CRIAR A EMISSÃO DE TAXAS VIA BOLETOS</strong>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DI_AGENCIA'>AGÊNCIA</label>
                    {!! Form::number('DI_AGENCIA', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_AGENCIA'))
                    <span class='text-danger'> {{ $errors->first('DI_AGENCIA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-1'>
                    <label for='DI_AGENCIA_DV'>DV</label>
                    {!! Form::number('DI_AGENCIA_DV', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_AGENCIA_DV'))
                    <span class='text-danger'> {{ $errors->first('DI_AGENCIA_DV') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_CONTA'>CONTA</label>
                    {!! Form::number('DI_CONTA', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_CONTA'))
                    <span class='text-danger'> {{ $errors->first('DI_CONTA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-1'>
                    <label for='DI_CONTA_DV'>DV</label>
                    {!! Form::number('DI_CONTA_DV', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_CONTA_DV'))
                    <span class='text-danger'> {{ $errors->first('DI_CONTA_DV') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_MULTA'>MULTA R$</label>
                    {!! Form::number('DI_MULTA', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_MULTA'))
                    <span class='text-danger'> {{ $errors->first('DI_MULTA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_JUROS'>JUROS %</label>
                    {!! Form::number('DI_JUROS', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_JUROS'))
                    <span class='text-danger'> {{ $errors->first('DI_JUROS') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_JUROSAPOS'>APÓS ?? DIAS</label>
                    {!! Form::number('DI_JUROSAPOS', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_JUROSAPOS'))
                    <span class='text-danger'> {{ $errors->first('DI_JUROSAPOS') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DI_DIASPROTESTO'>PROTESTAR APÓS</label>
                    {!! Form::number('DI_DIASPROTESTO', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_DIASPROTESTO'))
                    <span class='text-danger'> {{ $errors->first('DI_DIASPROTESTO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_CARTEIRA'>CARTEIRA</label>
                    {!! Form::text('DI_CARTEIRA', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_CARTEIRA'))
                    <span class='text-danger'> {{ $errors->first('DI_CARTEIRA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_VARIACAOCARTEIRA'>VAR CARTEIRA</label>
                    {!! Form::text('DI_VARIACAOCARTEIRA', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_VARIACAOCARTEIRA'))
                    <span class='text-danger'> {{ $errors->first('DI_VARIACAOCARTEIRA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_CONVENIO'>CONVENIO</label>
                    {!! Form::text('DI_CONVENIO', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_CONVENIO'))
                    <span class='text-danger'> {{ $errors->first('DI_CONVENIO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_RANGE'>DI_RANGE</label>
                    {!! Form::text('DI_RANGE', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_RANGE'))
                    <span class='text-danger'> {{ $errors->first('DI_RANGE') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_RANGE'>DI_CODIGOCLIENTE</label>
                    {!! Form::text('DI_CODIGOCLIENTE', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_CODIGOCLIENTE'))
                    <span class='text-danger'> {{ $errors->first('DI_CODIGOCLIENTE') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='DI_ACEITE'>DI_ACEITE</label>
                    {!! Form::text('DI_ACEITE', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_ACEITE'))
                    <span class='text-danger'> {{ $errors->first('DI_ACEITE') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='DI_ESPECIEDOC'>DI_ESPECIEDOC</label>
                    {!! Form::text('DI_ESPECIEDOC', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_ESPECIEDOC'))
                    <span class='text-danger'> {{ $errors->first('DI_ESPECIEDOC') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-4'>
                    <label for='DI_MENSAGEM1'>MENSAGEM</label>
                    {!! Form::text('DI_MENSAGEM1', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_MENSAGEM1'))
                    <span class='text-danger'> {{ $errors->first('DI_MENSAGEM1') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-4'>
                    <label for='DI_INSTRUCAO1'>INSTRUCAO 1</label>
                    {!! Form::text('DI_INSTRUCAO1', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_INSTRUCAO1'))
                    <span class='text-danger'> {{ $errors->first('DI_INSTRUCAO1') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-6'>
                    <label for='DI_INSTRUCAO2'>INSTRUCAO 2</label>
                    {!! Form::text('DI_INSTRUCAO2', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_INSTRUCAO2'))
                    <span class='text-danger'> {{ $errors->first('DI_INSTRUCAO2') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-6'>
                    <label for='DI_INSTRUCAO3'>INSTRUCAO 3</label>
                    {!! Form::text('DI_INSTRUCAO3', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('DI_INSTRUCAO3'))
                    <span class='text-danger'> {{ $errors->first('DI_INSTRUCAO3') }} </span>
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