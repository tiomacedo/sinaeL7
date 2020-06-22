@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li><a href='{{url('/restrito/debitos-tipo')}}'>MODALIDADES</a></li>
                        <li class='active'><a href='{{url('/restrito/debitos')}}'>DÉBITOS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>DÉBITOS | <small>REGISTRO DE PAGAMENTOS</small></h4>
        </div>
    </div>
</div>

<a href='{{url("/restrito/debitos/cadastrar")}}' 
   class='btn btn-primary waves-effect waves-light'>Novo Registro</a>
<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered  text-uppercase'>
                <thead>
                    <tr>
                        <th width='5px'>#</th>
                        <th >DESCRIÇÃO</th>
                        <th width='50px'>LANÇ.</th>
                        <th width='50px'>VENC.</th>
                        <th width='50px'>PGTO.</th>
                        <th width='65px'>VALOR R$</th>
                        <th width='30px'></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->DEB_CODIGO}}</td>
                        <td>{{$registro->TD_DESCRICAO}} - {{$registro->COMPLEMENTO}}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->DEB_DTLANCAMENTO)->format('d/m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->DEB_DTVENCIMENTO)->format('d/m/Y')}}</td>
                        <td>@if(isset($registro->DEB_DTPAGAMENTO) && $registro->DEB_DTPAGAMENTO!=null)
                                {{\Carbon\Carbon::parse($registro->DEB_DTPAGAMENTO)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td style='text-align: right'>{{number_format($registro->DEB_VALOR,2)}}</td>
                        <td style='text-align: right'>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir'
                               onclick="deletar('{{url("/restrito/debitos/deletar/$registro->DEB_CODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/debitos/editar/$registro->DEB_CODIGO")}}'
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