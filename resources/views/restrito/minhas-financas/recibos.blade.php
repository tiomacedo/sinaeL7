@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/meus-recibos')}}'>MEUS RECIBOS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title  text-uppercase'>MEUS RECIBOS | <small>{{Auth::user()->name}}</small></h4>
        </div>
    </div>
</div>


<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th width='60px'>MÊS REF.</th>
                        <th >DESCRIÇÃO</th>
                        <th width='50px'>VENC.</th>
                        <th width='50px'>PGTO.</th>
                        <th width='65px'>VALOR R$</th>
                        <th width='20px'></th>
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
                            <a href='{{url("/restrito/meus-recibos/$registro->REC_CODIGO")}}' 
                               class='btn waves-effect btn-orange btn-xs tooltip-hover' title='Visualizar Recibo'>
                                <i class='fa fa-barcode'></i>
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
@endpush

@endsection