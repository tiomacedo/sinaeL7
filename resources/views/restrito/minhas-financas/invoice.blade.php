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
            <h4 class='page-title text-uppercase'>MEUS RECIBOS | <small>{{Auth::user()->name}}</small></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            @foreach($data as $registro)
            <div class="panel-body">
                <div class="clearfix">
                    <div class="pull-left">
                        <h3><img src='{{url('/assets/images/logoCimadseta.jpg')}}' /></h3>
                    </div>
                    <div class="pull-right">
                        <div class="visible-print text-center">
                            {!! QrCode::size(100)->generate(Request::url()); !!}
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left m-t-30">
                            <address>
                                <strong>CIMADSETA</strong><br>
                                Avenida Mangalô, Quadra 07, Lote 107<br>
                                Setor Recanto do Bosque<br>
                                74474-322 - GOIÂNIA/GO<br>
                                Fone: (62)3092-1120
                            </address>
                        </div>

                        <div class="pull-right m-t-30 text-right">
                            <p><strong>Recebido em: </strong> {{ \Carbon\Carbon::parse($registro->REC_DTRECEBIMENTO)->format('d/m/Y')}}</p>
                            @if($diasVencido > 0)
                            <p><strong>Situação: </strong> <span class="label label-danger">Pago</span></p>
                            @else
                            <p><strong>Situação: </strong> <span class="label label-success">Pago</span></p>
                            @endif
                            <p><strong>ID: </strong> #{{$registro->REC_CODIGO}}-{{$registro->TR_CODIGO}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table m-t-30">
                                <tr class='invoice-tr-1'>
                                    <td>Valor Principal</td>
                                    <td  class='text-right' width='100px'>
                                        R$ @php $valorAtual = $registro->REC_VALOR; @endphp
                                        {{number_format($valorAtual, 2)}}
                                    </td>
                                </tr>
                                <tr class='invoice-tr'>
                                    <td>Data Vencimento</td>
                                    <td class='text-right'>
                                        @php $vencimento = \Carbon\Carbon::parse($registro->REC_DTVENCIMENTO)->format('d/m/Y') @endphp
                                        {{$vencimento}}
                                    </td>
                                </tr>
                                <tr class='invoice-tr'>
                                    <td>Data Pagamento</td>
                                    <td class='text-right'>
                                        @php $pagamento = \Carbon\Carbon::parse($registro->REC_DTPAGAMENTO)->format('d/m/Y') @endphp
                                        {{$pagamento}}
                                    </td>
                                </tr>
                                <tr class='invoice-tr'>
                                    <td>Dias de atraso</td>
                                    <td class='text-right'>{{$diasVencido}} dias</td>
                                </tr>
                                <tr class='invoice-tr'>
                                    <td>Juros e Mora</td><td>-</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h5 class="small text-inverse font-600">TERMOS E POLÍTICAS DE PAGAMENTO</h5>
                        <small>
                            Todas as contas devem ser pagas no prazo de 7 dias após o recebimento da fatura. 
                            Pagamentos por cheque, depósititos ou entregues em mãos de responsáveis pelos recolhimentos, 
                            serão baixados assim que os membros da tesouraria forem notificados.
                        </small>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                        <hr>
                        <h3 class="text-right">
                            R$ @php $total = $registro->REC_VALORRECEBIDO; @endphp
                            {{number_format($total, 2)}}
                        </h3>
                    </div>
                </div>
                <hr>
                <div class="hidden-print">
                    <div class="pull-right">
                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i> IMPRIMIR</a>
                    </div>
                </div>
            </div>
            @endforeach
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