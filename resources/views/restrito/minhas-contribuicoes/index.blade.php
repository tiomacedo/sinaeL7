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

<a href='{{url('/restrito/minhas-contribuicoes-cadastrar')}}' class='btn btn-primary waves-effect waves-light'>Novo Registro</a>
<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>

            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th width='60px'>MÊS REF.</th>
                        <th >DESCRIÇÃO</th>
                        <th width='50px'>PGTO.</th>
                        <th width='65px'>VALOR R$</th>
                        <th width='65px'>STATUS</th>
                        <th width='40px'></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($registro->REC_DTREFERENCIA)->format('m/Y')}}</td>
                        <td>
                            <b>{{$registro->TR_DESCRICAO}} 
                            </b> 
                            - (MÊS {{ \Carbon\Carbon::parse($registro->REC_DTREFERENCIA)->format('m/Y')}}) {{$registro->COMPLEMENTO}}
                        </td>
                        <td>@if(isset($registro->REC_DTRECEBIMENTO) && $registro->REC_DTRECEBIMENTO!=null)
                            {{\Carbon\Carbon::parse($registro->REC_DTRECEBIMENTO)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td style='text-align: right'>{{number_format($registro->REC_VALOR,2)}}</td>
                        <td style='text-align: center;'>
                            @if($registro->REC_STATUS == 'CONFIRMADO')
                                @php $class = 'success'; @endphp
                            @elseif($registro->REC_STATUS == 'EM-ANALISE')
                                @php $class = 'warning'; @endphp
                            @else
                                @php $class = 'purple'; @endphp
                            @endif
                            <span class="label label-{{$class}}">
                                {{ $registro->REC_STATUS }}
                            </span>
                        </td>
                        <td style='text-align: right'>
                        @if($registro->REC_STATUS == 'CONFIRMADO')
                        <a href='{{url("/restrito/meus-recibos/$registro->REC_CODIGO")}}' 
                               class='btn waves-effect btn-default btn-xs tooltip-hover' title='Visualizar Recibo'>
                                <i class='fa fa-barcode'></i>
                            </a>
                        @else
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir registro' 
                               onclick="deletar('{{url("/restrito/minhas-contribuicoes-deletar/$registro->REC_CODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/minhas-contribuicoes-editar/$registro->REC_CODIGO")}}' 
                               class='btn btn-xs waves-effect btn-success tooltip-hover' title='Editar registro'>
                                <i class='fa fa-pencil'></i>
                            </a>
                        @endif
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