@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li><a href='{{url('/restrito/receitas-tipo')}}'>MODALIDADES DAS RECEITAS</a></li>
                        <li class='active'><a href='{{url('/restrito/receitas')}}'>RECEBIMENTOS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>RECEITAS | <small>RECEBIMENTOS CONFIRMADOS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            @if(isset($data->REC_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/receitas/editar/$data->REC_CODIGO", 'method' => 'POST',
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/receitas/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/receitas/cadastrar' ]) !!}
            @endif

            <div class='row manager'>
                <div class='input-field col-md-4'>
                    <label for='REC_CODIGO'>DESCRIÇÃO</label>
                    <select name='TR_CODIGO' id='TR_CODIGO' class="select2 form-control" required>
                        @foreach($tipos as $tipo)
                        <option
                            @if(isset($data->TR_CODIGO) && ($data->TR_CODIGO==$tipo->TR_CODIGO)) @php echo 'selected'; @endphp @endif
                            value="{{$tipo->TR_CODIGO}}" >
                            {{$tipo->TR_DESCRICAO}}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('TR_CODIGO'))
                    <span class='text-danger'> {{ $errors->first('TR_CODIGO') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-5'>
                    <label for='user_id'>USUÁRIO</label>
                    <select name='user_id' id='user_id' class='select2 form-control'>
                        <option></option>
                        @forelse($users as $user)
                        <option
                            @if(isset($data->user_id) && ($data->user_id==$user->id)) @php echo 'selected'; @endphp @endif
                            value="{{$user->id}}" >
                            {{$user->name}}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                    <span class='text-danger'> {{ $errors->first('user_id') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-3'>
                    <label for='COMPLEMENTO'>COMPLEMENTO</label>
                    {!! Form::text('COMPLEMENTO', null, ['class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                    @if ($errors->has('COMPLEMENTO'))
                    <span class='text-danger'> {{ $errors->first('COMPLEMENTO') }} </span>
                    @endif
                </div>
            </div>

            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='REC_DTREFERENCIA'>DT. REFERÊNCIA</label>
                    {!! Form::date('REC_DTREFERENCIA', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('REC_DTREFERENCIA'))
                    <span class='text-danger'> {{ $errors->first('REC_DTREFERENCIA') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-2'>
                    <label for='REC_DTRECEBIMENTO'>DT. RECEBIMENTO</label>
                    {!! Form::date('REC_DTRECEBIMENTO', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('REC_DTRECEBIMENTO'))
                    <span class='text-danger'> {{ $errors->first('REC_DTRECEBIMENTO') }} </span>
                    @endif
                </div>

                <div class='input-field col-md-2'>
                    <label for='REC_VALOR'>VALOR R$</label>
                    {!! Form::text('REC_VALOR', null, ['class' => 'form-control autonumber', 'required' => 'yes']) !!}
                    @if ($errors->has('REC_VALOR'))
                    <span class='text-danger'> {{ $errors->first('REC_VALOR') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='REC_STATUS'>STATUS</label>
                    {{ Form::select('REC_STATUS', [
                                'CONFIRMADO' => 'CONFIRMADO',
                                'EM-ANALISE' => 'EM-ANALISE',
                                'STANDBY' => 'STANDBY',
                            ], null, ['id'=>'REC_STATUS','class' => 'form-control', 'required' => 'yes'])
                    }}
                    @if ($errors->has('REC_STATUS'))
                    <span class='text-danger'> {{ $errors->first('REC_STATUS') }} </span>
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

@push('js-footer')
    @if (session('status'))
    <script>
        Command: toastr["{{session('status')}}"]("{{session('mensagem')}}", "{{session('titulo')}}")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "positionClass": "toast-bottom-center",
            "showDuration": "700",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000"
        }
    </script>
    @endif
@endpush

@endsection