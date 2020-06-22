@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'> <a href='{{url('/restrito/missionarias')}}'>MISSIONÁRIAS</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>MISSIONÁRIAS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->id))
            {!! Form::model($data, ['url' => "/restrito/missionarias/editar/$data->id", 'method' => 'POST',
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/missionarias/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/missionarias/cadastrar' ]) !!}
            @endif

            <div class='row manager'>
                <div class='input-field col-md-4'>
                    <label for='IGR_CODIGO'>IGREJA QUE FREQUENTA</label>

                    <select name='IGR_CODIGO' id='IGR_CODIGO' class="select2 form-control" required>
                        @foreach($igrejas as $igreja)
                        <option
                            @if(isset($data->IGR_CODIGO) && ($data->IGR_CODIGO==$igreja->IGR_CODIGO)) @php echo 'selected'; @endphp @endif
                            value="{{$igreja->IGR_CODIGO}}" >
                            {{$igreja->IGR_MATRICULA}} - {{$igreja->END_BAIRRO}} - {{$igreja->CID_NOME}}/{{$igreja->CID_UF}}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('IGR_CODIGO'))
                <span class='text-danger'> {{ $errors->first('IGR_CODIGO') }} </span>
                @endif
            </div>
            <div class='input-field col-md-6'>
                <label for='name'>NOME</label>
                @if(isset($data->id))
                {!! Form::text('name', $data->name, ['class' => 'form-control', 'required' => 'yes', 'disabled']) !!}
                {!! Form::hidden('user_id', $data->user_id, ['class' => 'form-control', 'required' => 'yes', 'disabled']) !!}
                @else
                <select name='user_id' id='user_id' class="select2 form-control" required>
                    @foreach($missionaria as $missionaria)
                    <option value='{{$missionaria->id}}'>{{$missionaria->conjuge}}  (({{$missionaria->name}}))</option>
                    @endforeach
                </select>
                @endif
                @if ($errors->has('user_id'))
                <span class='text-danger'> {{ $errors->first('user_id') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='dtnascimento'>DT. NASC.</label>
                {!! Form::date('dtnascimento', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                @if ($errors->has('dtnascimento'))
                <span class='text-danger'> {{ $errors->first('dtnascimento') }} </span>
                @endif
            </div>
        </div>
        <div class='row manager'>
            <div class='input-field col-md-2'>
                <label for='cpf'>CPF</label>
                {!! Form::text('cpf', null, ['data-mask' => '999.999.999-99', 'min' => '13', 'maxlength' => '14', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                @if ($errors->has('cpf'))
                <span class='text-danger'> {{ $errors->first('cpf') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='rg'>RG</label>
                {!! Form::text('rg', null, ['id'=>'rg','min' => '5', 'maxlength' => '30', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                @if ($errors->has('rg'))
                <span class='text-danger'> {{ $errors->first('rg') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='titulo_eleitoral'>TÍTULO ELEITOR</label>
                {!! Form::text('titulo_eleitoral', null, ['data-mask' => '9999-9999-9999', 'id'=>'titulo_eleitoral', 'maxlength' => '30', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                @if ($errors->has('titulo_eleitoral'))
                <span class='text-danger'> {{ $errors->first('titulo_eleitoral') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='nacionalidade'>NACIONALIDADE</label>
                {{ Form::select('nacionalidade', [
                                'BRASILEIRA' => 'BRASILEIRA',
                                'ESTRANGEIRA' => 'ESTRANGEIRA',
                            ], null, ['id'=>'nacionalidade','class' => 'form-control', 'required'])
                }}
                @if ($errors->has('nacionalidade'))
                <span class='text-danger'> {{ $errors->first('nacionalidade') }} </span>
                @endif
            </div>
            <div class='input-field col-md-4'>
                <label for='naturalidade'>*NATURALIDADE</label>
                <select name='CID_CODIGO' id='CID_CODIGO' class="select2 form-control" required>
                    @foreach($cidades as $cidade)
                    <option
                        @if(isset($data->CID_CODIGO) && ($data->CID_CODIGO==$cidade->CID_CODIGO)) @php echo 'selected'; @endphp @endif
                        value="{{$cidade->CID_CODIGO}}" >
                        {{$cidade->CID_NOME}}/{{$cidade->CID_UF}}
                </option>
                @endforeach
            </select>
            @if ($errors->has('CID_CODIGO'))
            <span class='text-danger'> {{ $errors->first('CID_CODIGO') }} </span>
            @endif
        </div>
    </div>
    <div class='row manager'>
        <div class='input-field col-md-2'>
            <label for='profissao'>PROFISSÃO</label>
            {!! Form::text('profissao', null, ['id'=>'profissao','min' => '5', 'maxlength' => '200', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
            @if ($errors->has('profissao'))
            <span class='text-danger'> {{ $errors->first('profissao') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <label for='escolaridade'>ESCOLARIDADE</label>
            {{ Form::select('escolaridade', [
                                'ALFABETIZADO' => 'ALFABETIZADO',
                                'NÃO ALFABETIZADO' => 'NÃO ALFABETIZADO',
                                '1 GRAU INCOMPLETO' => '1 GRAU INCOMPLETO',
                                '1 GRAU COMPLETO' => '1 GRAU COMPLETO',
                                '2 GRAU INCOMPLETO' => '2 GRAU INCOMPLETO',
                                '2 GRAU COMPLETO' => '2 GRAU COMPLETO',
                                'SUPERIOR INCOMPLETO' => 'SUPERIOR INCOMPLETO',
                                'SUPERIOR COMPLETO' => 'SUPERIOR COMPLETO',

                    ], null, ['id'=>'escolaridade','class' => 'form-control'])
            }}
            @if ($errors->has('escolaridade'))
            <span class='text-danger'> {{ $errors->first('escolaridade') }} </span>
            @endif
        </div>
        <div class='input-field col-md-3'>
            <label for='mae'>MÃE</label>
            {!! Form::text('mae', null, ['id'=>'mae','min' => '5', 'maxlength' => '120', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
            @if ($errors->has('mae'))
            <span class='text-danger'> {{ $errors->first('mae') }} </span>
            @endif
        </div>
        <div class='input-field col-md-3'>
            <label for='pai'>PAI</label>
            {!! Form::text('pai', null, ['id'=>'pai', 'maxlength' => '120', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
            @if ($errors->has('pai'))
            <span class='text-danger'> {{ $errors->first('pai') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <label for='estadocivil'>EST. CIVIL</label>
            {{ Form::select('estadocivil', [
                                'CASADA' => 'CASADA',
                                'SEPARADA' => 'SEPARADA',
                                'DIVORCIADA' => 'DIVORCIADA',
                                'VIÚVA' => 'VIÚVA',
                    ], null, ['id'=>'estadocivil','class' => 'form-control'])
            }}
            @if ($errors->has('estadocivil'))
            <span class='text-danger'> {{ $errors->first('estadocivil') }} </span>
            @endif
        </div>
    </div>
    <div class='row manager'>
        <div class='input-field col-md-2'>
            <label for='dtviuvez'>DT. VIUVEZ</label>
            {!! Form::date('dtviuvez', null, ['class' => 'form-control']) !!}
            @if ($errors->has('dtviuvez'))
            <span class='text-danger'> {{ $errors->first('dtviuvez') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <label for='phone'>FONE</label>
            {!! Form::text('phone', null, ['data-mask' => '(99)9999.9999', 'min' => '13', 'maxlength' => '14', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
            @if ($errors->has('phone'))
            <span class='text-danger'> {{ $errors->first('phone') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <label for='cellphone'>CELULAR</label>
            {!! Form::text('cellphone', null, ['data-mask' => '(99)99999.9999', 'min' => '13', 'maxlength' => '14', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
            @if ($errors->has('cellphone'))
            <span class='text-danger'> {{ $errors->first('cellphone') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <label for='cellphone2'>CELULAR2</label>
            {!! Form::text('cellphone2', null, ['data-mask' => '(99)99999.9999', 'min' => '13', 'maxlength' => '14', 'class' => 'form-control']) !!}
            @if ($errors->has('cellphone2'))
            <span class='text-danger'> {{ $errors->first('cellphone2') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <label for='email'>E-MAIL</label>
            {!! Form::email('email', null, ['min' => '12', 'maxlength' => '250', 'class' => 'form-control', 'style' => 'text-transform: lowercase', 'required' => 'yes']) !!}
            @if ($errors->has('email'))
            <span class='text-danger'> {{ $errors->first('email') }} </span>
            @endif
        </div>
        <div class='input-field col-md-2'>
            <div class='form-group'>
                <label for='password'>SENHA</label>
                {!! Form::password('password', ['id'=>'password', 'min' => '6', 'maxlength' => '20', 'class' => 'form-control']) !!}
            </div>
            @if ($errors->has('password'))
            <span class='text-danger'> {{ $errors->first('password') }} </span>
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