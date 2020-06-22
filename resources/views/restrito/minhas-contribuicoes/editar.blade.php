@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/minhas-contribuicoes')}}'>MINHAS CONTRIBUIÇÕES</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title text-uppercase'>MINHAS CONTRIBUIÇÕES | <small>{{Auth::user()->name}}</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-md-12">
        <div class='card-box table-responsive'>
            {!! Form::model($data, ['url' => "/restrito/minhas-contribuicoes-editar/$data->REC_CODIGO", 
            'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='REC_DTRECEBIMENTO'>DT. DA TRANSAÇÃO</label>
                    {!! Form::date('REC_DTRECEBIMENTO', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('REC_DTRECEBIMENTO'))
                    <span class='text-danger'> {{ $errors->first('REC_DTRECEBIMENTO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-3'>
                    <label for='TR_CODIGO'>TIPO DA RECEITA</label>
                    <select name="TR_CODIGO" class="form-control">

                     <option value="1" @if($data->TR_CODIGO == 1) @php echo 'selected'; @endphp @endif >DEPÓSITO BANCÁRIO</option>
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
                <div class='input-field col-md-3'>
                    <label for='REC_COLETOR'>VALOR ENTREGUE A:</label>
                    <select name='REC_COLETOR' id='REC_COLETOR' class="select2 form-control" required>
                        <option value="1">DEPÓSITO BANCÁRIO</option>
                        @forelse($coletores as $coletor)
                        <option value="{{$coletor->id}}">{{$coletor->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('REC_COLETOR'))
                    <span class='text-danger'> {{ $errors->first('REC_COLETOR') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='REC_DTREFERENCIA'>MÊS DE REFERÊNCIA</label>
                    {!! Form::date('REC_DTREFERENCIA', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('REC_DTREFERENCIA'))
                    <span class='text-danger'> {{ $errors->first('REC_DTREFERENCIA') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='REC_VALOR'>VALOR R$</label>
                    {!! Form::text('REC_VALOR', null, ['class'=>'form-control autonumber', 'required' => 'yes']) !!}
                    @if ($errors->has('REC_VALOR'))
                    <span class='text-danger'> {{ $errors->first('REC_VALOR') }} </span>
                    @endif
                </div>
            </div>

            <div class='modal-footer'>
                <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
                <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@push('css')
@endpush

@push('js-topo')
@endpush

@push('js-footer')
@endpush

@endsection