@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/igrejas')}}'>IGREJAS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>IGREJAS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->IGR_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/igrejas/editar/$data->IGR_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/igrejas/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/igrejas/cadastrar' ]) !!}
            @endif 


            <div class='row manager'>
                <div class='input-field col-md-1'>
                    <label for='ARE_CODIGO'>ÁREA</label>
                    <select name='ARE_CODIGO' id='ARE_CODIGO' class='form-control select2'>
                        @foreach($areas as $area)
                        <option @if(isset($data->IGR_CODIGO) && ($data->ARE_CODIGO==$area->ARE_CODIGO)) @php echo 'selected'; @endphp @endif value="{{$area->ARE_CODIGO}}" >
                                 {{$area->ARE_CODIGOMANUAL}}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('ARE_CODIGO'))
                <span class='text-danger'> {{ $errors->first('ARE_CODIGO') }} </span>
                @endif
            </div>
            <div class='input-field col-md-3'>
                <label for='IGR_RESPONSAVEL'>PASTOR PRESIDENTE</label>
                {!! Form::text('IGR_RESPONSAVEL', null, ['required' => 'yes', 'min' => '10', 'maxlength' => '120', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                @if ($errors->has('IGR_RESPONSAVEL'))
                <span class='text-danger'> {{ $errors->first('IGR_RESPONSAVEL') }} </span>
                @endif
            </div>

            <div class='input-field col-md-1'>
                <label for='IGR_MATRICULA'>MATR.</label>
                {!! Form::text('IGR_MATRICULA', null, ['required' => 'yes', 'data-mask' => '99-99', 'maxlength' => '6', 'class' => 'form-control']) !!}
                @if ($errors->has('IGR_MATRICULA'))
                <span class='text-danger'> {{ $errors->first('IGR_MATRICULA') }} </span>
                @endif
            </div>
            <div class='input-field col-md-3'>
                <label for='IGR_NOMECONGRECACAO'>NOME DA CONGREGAÇÃO</label>
                {!! Form::text('IGR_NOMECONGRECACAO', null, ['required' => 'yes', 'min' => '10', 'maxlength' => '60', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                @if ($errors->has('IGR_NOMECONGRECACAO'))
                <span class='text-danger'> {{ $errors->first('IGR_NOMECONGRECACAO') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_FONE'>TELEFONE</label>
                {!! Form::text('IGR_FONE', null, ['data-mask' => '(99)9999-9999', 'maxlength' => '14', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                @if ($errors->has('IGR_FONE'))
                <span class='text-danger'> {{ $errors->first('IGR_FONE') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_CELULAR'>CELULAR</label>
                {!! Form::text('IGR_CELULAR', null, ['data-mask' => '(99)99999-9999', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                @if ($errors->has('IGR_CELULAR'))
                <span class='text-danger'> {{ $errors->first('IGR_CELULAR') }} </span>
                @endif
            </div>
        </div>

        <div class='row manager'>
            <div class='input-field col-md-2'>
                <label for='IGR_CNPJ'>CNPJ</label>
                {!! Form::text('IGR_CNPJ', null, ['data-mask' => '99.999.999/9999-99', 'required' => 'yes', 'min' => '18', 'maxlength' => '18', 'style' => 'text-transform: uppercase', 'class' => 'form-control']) !!}
                @if ($errors->has('IGR_CNPJ'))
                <span class='text-danger'> {{ $errors->first('IGR_CNPJ') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_TEMPLO'>SIT. TEMPLO</label>
                {{ Form::select('IGR_TEMPLO', [
                                        'PRÓPRIO' => 'PRÓPRIO', 
                                        'ALUGADO' => 'ALUGADO', 
                                        'COMODATO' => 'COMODATO', 
                                    ], null, ['class' => 'form-control','required' => 'yes'])
                }}
                @if ($errors->has('IGR_TEMPLO'))
                <span class='text-danger'> {{ $errors->first('IGR_TEMPLO') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDMISSIONARIOS'>Nº MISSIONÁRIOS</label>
                {!! Form::number('IGR_QTDMISSIONARIOS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDMISSIONARIOS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDMISSIONARIOS') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDDIACONOS'>Nº DIÁCONOS</label>
                {!! Form::number('IGR_QTDDIACONOS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDDIACONOS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDDIACONOS') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDPRESBITEROS'>Nº PRESBÍTEROS</label>
                {!! Form::number('IGR_QTDPRESBITEROS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDPRESBITEROS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDPRESBITEROS') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDEVANGELISTAS'>Nº EVANGELISTAS</label>
                {!! Form::number('IGR_QTDEVANGELISTAS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDEVANGELISTAS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDEVANGELISTAS') }} </span>
                @endif
            </div>
        </div>

        <div class='row'>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDPASTORES'>Nº PASTORES</label>
                {!! Form::number('IGR_QTDPASTORES', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDPASTORES'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDPASTORES') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDMEMBROS'>Nº MEMBROS</label>
                {!! Form::number('IGR_QTDMEMBROS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDMEMBROS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDMEMBROS') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDELEITORESCIDADE'>ELEITORES CIDADE</label>
                {!! Form::number('IGR_QTDELEITORESCIDADE', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDELEITORESCIDADE'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDELEITORESCIDADE') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDELEITORESIGREJA'>ELEITORES IGREJA</label>
                {!! Form::number('IGR_QTDELEITORESIGREJA', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDELEITORESIGREJA'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDELEITORESIGREJA') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDMEMBROSPOLITICOS'>Nº POLÍTICOS</label>
                {!! Form::number('IGR_QTDMEMBROSPOLITICOS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDMEMBROSPOLITICOS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDMEMBROSPOLITICOS') }} </span>
                @endif
            </div>
            <div class='input-field col-md-2'>
                <label for='IGR_QTDFUNCIONARIOSPUBLICOS'>FUNC's. PÚBLICO</label>
                {!! Form::number('IGR_QTDFUNCIONARIOSPUBLICOS', null, ['required' => 'yes','class' => 'form-control']) !!}
                @if ($errors->has('IGR_QTDFUNCIONARIOSPUBLICOS'))
                <span class='text-danger'> {{ $errors->first('IGR_QTDFUNCIONARIOSPUBLICOS') }} </span>
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