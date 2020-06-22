@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        @php $link = strtolower($tipo) @endphp
                        <li class='active'> <a href='{{url("/restrito/eventos/$link")}}'>EVENTOS</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>EVENTOS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            @if(isset($data->EVEN_CODIGO))
            {!! Form::model($data, ['url' => "/restrito/eventos/editar/$data->EVEN_CODIGO", 'method' => 'POST', 
            'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => '/restrito/eventos/cadastrar', 'method' => 'POST', 'class' => 'form-horizontal',
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/eventos/cadastrar' ]) !!}
            @endif 
            <div class='row manager'>
                <div class='input-field col-md-2'>
                    <label for='EVEN_TIPO'>MODALIDADE</label>
                    {!! Form::select('EVEN_TIPO', [
                                        'AGO' => 'AGO', 
                                        'AGE' => 'AGE', 
                            ], strtoupper($tipo), ['class' => 'form-control'])
                    !!}
                    @if ($errors->has('EVEN_TIPO'))
                    <span class='text-danger'> {{ $errors->first('EVEN_TIPO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-10'>
                    <label for='EVEN_TITULO'>TITULO</label>
                    {!! Form::text('EVEN_TITULO', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('EVEN_TITULO'))
                    <span class='text-danger'> {{ $errors->first('EVEN_TITULO') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-12'>
                    <label for='EVEN_TEXTO'>TEXTO DE CONVOCAÇÃO</label>
                    {!! Form::textarea('EVEN_TEXTO', null, ['class' => 'form-control', 'required' => 'yes', 'id'=>'EVEN_TEXTO' ]) !!}
                    @if ($errors->has('EVEN_TEXTO'))
                    <span class='text-danger'> {{ $errors->first('EVEN_TEXTO') }} </span>
                    @endif
                </div>
            </div>
            <div class='row manager'>
                <div class='input-field col-md-8'>
                    <label for='EVEN_LOCAL'>LOCAL</label>
                    {!! Form::text('EVEN_LOCAL', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('EVEN_LOCAL'))
                    <span class='text-danger'> {{ $errors->first('EVEN_LOCAL') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='EVEN_DTINICIO'>DATA INÍCIO</label>
                    {!! Form::date('EVEN_DTINICIO', null, ['class'=>'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('EVEN_DTINICIO'))
                    <span class='text-danger'> {{ $errors->first('EVEN_DTINICIO') }} </span>
                    @endif
                </div>
                <div class='input-field col-md-2'>
                    <label for='EVEN_DTFINAL'>DATA ENCERRAMENTO</label>
                    {!! Form::date('EVEN_DTFINAL', null, ['class'=>'form-control', 'required' => 'yes']) !!}
                    @if ($errors->has('EVEN_DTFINAL'))
                    <span class='text-danger'> {{ $errors->first('EVEN_DTFINAL') }} </span>
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

@push('css')
<link href='{{url('/assets/plugins/summernote/summernote.css')}}' rel='stylesheet' />
@endpush

@push('js-footer')
<script src='{{url('/assets/plugins/summernote/summernote.min.js')}}'></script>
<script type="text/javascript">
   jQuery(document).ready(function () {
        $('#EVEN_TEXTO').summernote({
            height: 200, // set editor height
           minHeight: null, // set minimum height of editor
           maxHeight: null, // set maximum height of editor
           focus: false,     // set focus to editable area after initializing summernote
           toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        //['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        //['para', ['ul', 'ol', 'paragraph']],
                        ['para', ['ul', 'ol']],
                        //['height', ['height']],
                        ['link', ['link']],
                        ['table', ['table']]
                    ]
       });
       $('.inline-editor').summernote({
           airMode: true
       });
   });
</script>
@endpush

@endsection