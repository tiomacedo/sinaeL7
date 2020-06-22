@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'> <a href='{{url('/restrito/patrimonios')}}'>PATRIMÔNIOS</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>PATRIMÔNIOS | <small>GERENCIAMENTO DOS REGISTROS</small></h4>
        </div>
    </div>
</div>

<a href='{{url("/restrito/patrimonios/cadastrar")}}' 
   class='btn btn-primary waves-effect waves-light'>Novo Registro</a>
<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th width='5px'>#</th>
                        <th >DESCRIÇÃO</th>
                        <th>MARCA</th>
                        <th width='50px'>COMPRA</th>
                        <th>ESTADO</th>
                        <th width='80px'>R$ COMPRA</th>
                        <th width='50px'>V. ÚTIL</th>
                        <th width='65px'>R$ ATUAL</th>
                        <th width='30px'>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->PAT_CODIGO}}</td>
                        <td>{{$registro->PAT_TIPO}}</td>
                        <td>{{$registro->PAT_MARCA}}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->PAT_DATAAQUISICAO)->format('d/m/Y')}}</td>
                        <td>{{$registro->PAT_ESTADO}}</td>
                        <td style='text-align: right'>{{number_format($registro->PAT_VALOR,2)}}</td>
                        <td>{{$registro->PAT_ANOSUTEIS}} ANOS</td>
                        <td style='text-align: right'>
                            @php
                            $anoAtual =  \Carbon\Carbon::now()->year;
                            $anoCompra = \Carbon\Carbon::parse($registro->PAT_DATAAQUISICAO)->format('Y');
                            $depreciacao = $registro->PAT_ANOSUTEIS/100;
                            $idade = $anoAtual-$anoCompra;
                            //$valorAtual = $registro->PAT_VALOR * $depreciacao;
                            $valorAtual = $registro->PAT_VALOR - (($registro->PAT_VALOR * $depreciacao) * $idade);
                            echo number_format($valorAtual,2);
                            @endphp
                        <td style='text-align: right'>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir'
                               onclick="deletar('{{url("/restrito/patrimonios/deletar/$registro->PAT_CODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/patrimonios/editar/$registro->PAT_CODIGO")}}' 
                               class='btn btn-xs waves-effect btn-success tooltip-hover' title='Editar'>
                                <i class='fa fa-pencil'></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan='20'>Nenhum dado inserido até o momento</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('css')
@endpush

@push('js-topo')
@endpush

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