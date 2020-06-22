@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li> <a href='{{url('/restrito/solicitacoes')}}'>SOLICITAÇÕES</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>SOLICITAÇÕES | <small>GERENCIAMENTO DOS REGISTROS</small></h4>
        </div>
    </div>
</div>


<div class='row solicitacoes' id='solicitacoes'>
    <div class='col-md-2'>
        <div class="timeline timeline-left">
            <article class="timeline-item alt">
                <div class="text-left">
                    <div class="time-show first">
                        <a href='' class='btn btn-primary waves-effect waves-light' data-toggle='modal' data-target='#modalForm' onclick='erase()'>Abrir Chamado</a>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <div class="col-sm-10">
    @foreach($data as $registro)
        <div class="timeline timeline-left">
            <article class="timeline-item alt">
                <div class="text-left">
                    <div class="time-show first">
                        <a class="btn btn-danger w-lg">{{$registro->name}}</a>
                    </div>
                </div>
            </article>
            <article class="timeline-item">
                <div class="timeline-desk">
                    <div class="panel">
                        <div class="timeline-box">
                            <span class="arrow"></span>
                            <span class="timeline-icon"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                            <p class="timeline-date text-muted">
                                <small>
                                    {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y H:i')}}
                                </small>
                            </p>
                            <p>{!!$registro->SOL_PEDIDO!!}</p>
                            <hr/>
                            <a href='#' class='btn btn-xs waves-effect btn-danger'
                               onclick="deletar('{{url("/restrito/solicitacao/deletar/$registro->SOL_CODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            
            @if(isset($registro->SOL_RESPOSTA) && $registro->SOL_RESPOSTA != null)
            <article class="timeline-item ">
                <div class="timeline-desk">
                    <div class="panel">
                        <div class="timeline-box">
                            <span class="arrow"></span>
                            <span class="timeline-icon bg-success"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                            <h4 class="text-success">CIMADSETA</h4>
                            <p class="timeline-date text-muted"><small>{{$registro->update_at}}</small></p>
                            <p>{{$registro->SOL_RESPOSTA}}</p>
                        </div>
                    </div>
                </div>
            </article>
            @endif

        </div>
    @endforeach
    </div>
</div>

<div id='modalForm' class='modal fade' role='dialog' aria-labelledby='full-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog modal-full'>
        <div class='modal-content'>
            <form method='POST' action="{{url('/restrito/solicitacao/cadastrar')}}" id='form' role='form' 
                  class='form-horizontal' form-send="{{url('/restrito/solicitacao/cadastrar')}}">
                {{csrf_field()}}

                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                    <h4>SOLICITAÇÕES | <span class='small-text text-lighten-1'>Formulário de Gerenciamento</span></h4>
                </div>
                <div class='modal-body'>
                    <div class='row manager'>
                        <div class='input-field col-md-12'>
                            <label for='SOL_PEDIDO'>SOLICITAÇÃO</label>
                            <textarea name='SOL_PEDIDO' id='SOL_PEDIDO' class='form-control'>
                                
                            </textarea>
                            <span class='color-danger' id='label-error-SOL_PEDIDO' style='display: none;'></span>
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
                    <button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Fechar</button>
                    <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js-topo')
@endpush

@push('css')
<link href='{{url('/assets/plugins/summernote/summernote.css')}}' rel='stylesheet' />
@endpush

@push('js-footer')
<script src='{{url('/assets/plugins/summernote/summernote.min.js')}}'></script>
<script type="text/javascript">
   jQuery(document).ready(function () {
        $('#SOL_PEDIDO').summernote({
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