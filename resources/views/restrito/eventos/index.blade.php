@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        @if(isset($tipo) && $tipo == 'ago')
                        @php $evento = 'ASSEMBLEIA GERAL ORDINÁRIA'; @endphp
                        <li class='active'><a href='{{url('/restrito/eventos/ago')}}'>{{$evento}}</a></li>
                        @else
                        @php $evento = 'ASSEMBLEIA GERAL EXTRAORDINÁRIA'; @endphp
                        <li class='active'><a href='{{url('/restrito/eventos/age')}}'>{{$evento}}</a></li>
                        @endif
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>EVENTOS | <small>{{$evento}}</small></h4>
        </div>
    </div>
</div>


<a href='{{url("/restrito/eventos/cadastrar/$tipo")}}' class='btn btn-primary waves-effect waves-light'>Novo Registro</a>
<div class='row solicitacoes m-b-30' id='solicitacoes'>
    @foreach($data as $registro)
    <div class='row m-b-30'>
        <div class='col-sm-9'>
            <div class='card-box table-responsive'>
                <h3>{{$registro->EVEN_TITULO}} <br/><br/></h3>
                <p class="text-justify">{!!$registro->EVEN_TEXTO!!}</p>
            </div>
        </div>

        <div class='col-sm-3'>
            <div class='row'>
                <div class='card-box widget-box-two widget-two-info'>
                    <i class='mdi mdi-chart-areaspline widget-two-icon'></i>
                    <div class='wigdet-two-content text-white'>
                        <p class='m-0 text-uppercase font-600 font-secondary text-overflow' title='Data'>Data</p>
                        <h2 class='text-white'><span data-plugin='counterup'>
                                DE {{ \Carbon\Carbon::parse($registro->EVEN_DTINICIO)->format('d/m')}} A
                                {{ \Carbon\Carbon::parse($registro->EVEN_DTFINAL)->format('d/m/Y')}}
                            </span> <small><i class='mdi mdi-arrow-up text-success'>
                                    
                                </i></small></h2>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='card-box widget-box-two widget-two-info'>
                    <i class='mdi mdi-chart-areaspline widget-two-icon'></i>
                    <div class='wigdet-two-content text-white'>
                        <p class='m-0 text-uppercase font-600 font-secondary text-overflow' title='Local'>Local</p>
                        <h2 class='text-white'><span data-plugin='counterup'>{{$registro->EVEN_LOCAL}}</span> <small><i class='mdi mdi-arrow-up text-success'></i></small></h2>
                    </div>
                </div>
            </div>

            @can('GERENCIAMENTO DE EVENTOS')
            <div class='row'>
                <a href='#' class='btn waves-effect btn-danger'
                   onclick="deletar('{{url("/restrito/eventos/deletar/$registro->EVEN_CODIGO")}}')" id='urlDeletar'>
                    <i class='fa fa-trash'></i> EXCLUIR
                </a>
                <br/>
                <a href='{{url("/restrito/eventos/editar/$registro->EVEN_CODIGO")}}' 
                   class='btn waves-effect btn-success'>
                    <i class='fa fa-pencil'></i> EDITAR
                </a>
            </div>
            @endcan


        </div>


        <hr class='m-t-15 m-b-15 color-danger' />
        @endforeach
    </div>
</div>







@push('css')
<link href='{{url('/assets/plugins/summernote/summernote.css')}}' rel='stylesheet' />
@endpush

@push('js-topo')
@endpush

@push('js-footer')
<script src='{{url('/assets/plugins/summernote/summernote.min.js')}}'></script>
<script type="text/javascript">
                           jQuery(document).ready(function () {
                   $('#EVEN_TEXTO').summernote({
                   height: 200, // set editor height
                           minHeight: null, // set minimum height of editor
                           maxHeight: null, // set maximum height of editor
                           focus: false     // set focus to editable area after initializing summernote
                   });
                   $('.inline-editor').summernote({
                   airMode: true
                   });
                   });
</script>
@endpush

@endsection