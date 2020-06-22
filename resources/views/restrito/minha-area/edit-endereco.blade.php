@extends('layouts.restrito')
@section('content')

<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        @if(isset($tipo) && $tipo == 'usuarios')
                            @php 
                                $link = 'ministros-missionarias'; 
                                $titulo = 'MINISTROS E MISSIONÁRIAS'; 
                            @endphp
                        @endif
                        @if(isset($tipo) && $tipo == 'igrejas')
                            @php $link = 'igrejas' @endphp
                            @php $titulo = 'IGREJAS' @endphp
                        @endif
                        <li> <a href='{{url("/restrito/minha-area/$link")}}'>{{$titulo}}</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>ENDEREÇOS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            @if(isset($data->END_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/minha-area/$tipo/enderecos/editar/$data->END_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => "/restrito/minha-area/$tipo/enderecos/cadastrar/{$id}", 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/enderecos/cadastrar' ]) !!}
            @endif 

            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='END_CEP'>CEP</label>
                    {!! Form::text('END_CEP', null, ['data-mask' => '99.999-999', 'min' => '10', 'maxlength' => '10', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                    @if ($errors->has('END_CEP'))
                    <span class='text-danger'> {{ $errors->first('END_CEP') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-5'>
                    <label for='END_LOGRADOURO'>ENDEREÇO</label>
                    {!! Form::text('END_LOGRADOURO', null, ['min' => '0', 'maxlength' => '100', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                   
                    @if ($errors->has('END_LOGRADOURO'))
                    <span class='text-danger'> {{ $errors->first('END_LOGRADOURO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='END_TIPOLOGRADOURO'>ENDEREÇO</label>
                    {{ Form::select('END_TIPOLOGRADOURO', [
                                    'CASA' => 'CASA', 
                                    'APARTAMENTO' => 'APARTAMENTO', 
                                    'SALA' => 'SALA', 
                                    'LOTE' => 'LOTE'
                        ], null, ['class' => 'form-control'])
                    }}
                    @if ($errors->has('END_TIPOLOGRADOURO'))
                    <span class='text-danger'> {{ $errors->first('END_TIPOLOGRADOURO') }} </span>
                    @endif
          
                </div>
                <div class='input-field col-md-1'>
                    <label for='END_NUMERO'>Nº</label>
                    {!! Form::text('END_NUMERO', null, ['min' => '', 'maxlength' => '7', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
      
                    @if ($errors->has('END_TIPOLOGRADOURO'))
                    <span class='text-danger'> {{ $errors->first('END_TIPOLOGRADOURO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='END_COMPLEMENTO'>COMPLEMENTO</label>
                    {!! Form::text('END_COMPLEMENTO', null, ['min' => '', 'maxlength' => '20', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
        
                    @if ($errors->has('END_COMPLEMENTO'))
                    <span class='text-danger'> {{ $errors->first('END_COMPLEMENTO') }} </span>
                    @endif
                </div>
            </div>

            <div class='row manager'>
                <div class='input-field col-md-4'>
                    <label for='END_BAIRRO'>BAIRRO</label>
                    {!! Form::text('END_BAIRRO', null, ['maxlength' => '50', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
        
                    @if ($errors->has('END_BAIRRO'))
                    <span class='text-danger'> {{ $errors->first('END_BAIRRO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-4'>
                    <label for='CID_CODIGO'>CIDADE</label>
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

                <div class='input-field col-md-3'>
                    <label for='END_DESCRICAOERRO'>
                        MOTIVO DEVOLUÇÃO
                    </label>
                    {!! Form::text('END_DESCRICAOERRO', null, ['maxlength' => '200', 'class' => 'form-control', 'style' => 'text-transform: uppercase',]) !!}
             
                    @if ($errors->has('END_DESCRICAOERRO'))
                    <span class='text-danger'> {{ $errors->first('END_DESCRICAOERRO') }} </span>
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