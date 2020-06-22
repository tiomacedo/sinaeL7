@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li><a href='{{url('/restrito/receitas-tipo')}}'>MODALIDADES</a></li>
                        <li class='active'><a href='{{url('/restrito/receitas')}}'>RECEITAS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>RECEITAS | <small>REGISTRO DE ENTRADAS</small></h4>
        </div>
    </div>
</div>

<a href='{{url("/restrito/receitas/cadastrar")}}' 
   class='btn btn-primary waves-effect waves-light'>Novo Registro</a>
<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th width='5px'>#</th>
                        <th >DESCRIÇÃO</th>
                        <th width='50px'>STATUS</th>
                        <th width='50px'>DT. REF.</th>
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
                        <td>{{$registro->REC_CODIGO}}</td>
                        <td>
                            <b>{{$registro->TR_DESCRICAO}} 
                                MÊS {{ \Carbon\Carbon::parse($registro->REC_DTREFERENCIA)->format('m/Y')}}
                            </b> 
                            - {{$registro->name}} 
                            - {{$registro->COMPLEMENTO}}
                        </td>
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
                        <td>{{ \Carbon\Carbon::parse($registro->REC_DTREFERENCIA)->format('m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->REC_DTLANCAMENTO)->format('d/m/Y')}}</td>
                        <td>
                            @if(isset($registro->REC_DTVENCIMENTO) && $registro->REC_DTVENCIMENTO!=null)
                            {{\Carbon\Carbon::parse($registro->REC_DTVENCIMENTO)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td>@if(isset($registro->REC_DTRECEBIMENTO) && $registro->REC_DTRECEBIMENTO!=null)
                            {{\Carbon\Carbon::parse($registro->REC_DTRECEBIMENTO)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td style='text-align: right'>{{number_format($registro->REC_VALOR,2)}}</td>
                        <td style='text-align: right'>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir'
                               onclick="deletar('{{url("/restrito/receitas/deletar/$registro->REC_CODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/receitas/editar/$registro->REC_CODIGO")}}' 
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