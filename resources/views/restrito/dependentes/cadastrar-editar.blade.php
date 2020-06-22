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
            <h4 class='page-title'>DEPENDENTES | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->DEP_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/$tipo/dependentes/editar/$data->DEP_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => "/restrito/$tipo/dependentes/cadastrar/{$id}", 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/dependentess/cadastrar' ]) !!}
            @endif 

            <div class='row'>
                <div class='input-field col-md-7'>
                    <label for='DEP_NOME'>NOME</label>
                    {!! Form::text('DEP_NOME', null, ['min' => '10', 'maxlength' => '120', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('DEP_NOME'))
                    <span class='text-danger'> {{ $errors->first('DEP_NOME') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='DEP_GRAUPARENTESCO'>GRAU DE PARENTESCO</label>
                    
                    @if($tipo == 'ministros')
                    {{ Form::select('DEP_GRAUPARENTESCO', [
                                        'FILHO(A) OU ENTEADO(A)' => 'FILHO(A) OU ENTEADO(A)', 
                                        'PAI / MÃE' => 'PAI / MÃE', 
                                        'IRMÃO(Ã)' => 'IRMÃO(Ã)', 
                                        'TIO(A)' => 'TIO(A)', 
                                        'AVÔ(Ó)' => 'AVÔ(Ó)', 
                            ], null, ['class' => 'form-control'])
                    }}
                    @else
                    {{ Form::select('DEP_GRAUPARENTESCO', [
                                        'FILHO(A) OU ENTEADO(A)' => 'FILHO(A) OU ENTEADO(A)', 
                                        'PAI / MÃE DA MISSIONÁRIA' => 'PAI / MÃE DA MISSIONÁRIA', 
                                        'IRMÃO(Ã) DA MISSIONÁRIA' => 'IRMÃO(Ã) DA MISSIONÁRIA', 
                                        'TIO(A) DA MISSIONÁRIA' => 'TIO(A) DA MISSIONÁRIA', 
                                        'AVÔ(Ó) DA MISSIONÁRIA' => 'AVÔ(Ó) DA MISSIONÁRIA', 
                            ], null, ['class' => 'form-control'])
                    }}
                    @endif

                    @if ($errors->has('DEP_GRAUPARENTESCO'))
                    <span class='text-danger'> {{ $errors->first('DEP_GRAUPARENTESCO') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-2'>
                    <label for='DEP_DATANASCIMENTO'>DT. NASCIMENTO</label>
                    {!! Form::date('DEP_DATANASCIMENTO', null, ['class'=>'form-control']) !!}
                    @if ($errors->has('DEP_DATANASCIMENTO'))
                    <span class='text-danger'> {{ $errors->first('DEP_DATANASCIMENTO') }} </span>
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