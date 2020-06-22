@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'>Transparência</li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>PRESTAÇÃO DE CONTAS | <small>Portal Transparência</small></h4>
        </div>
    </div>
</div>


<div class='row'>
    <div class='col-sm-6'>
        <div class='card-box'>
            <h5>Receitas em @php echo date('Y') @endphp</h5>
            <div id="chart-receitas" style="width: 100%; height: 250px;"></div>
        </div>
    </div>
    <div class='col-sm-6'>
        <div class='card-box'>
            <h5>Débitos em @php echo date('Y') @endphp</h5>
            <div id="chart-debitos" style="width: 100%; height: 250px;"></div>
        </div>
    </div>
</div>




<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box'>

            <h5>DISPONIBILIDADES</h5>
            <div class="table-responsive">
                <table class='table table-striped table-bordered table-smal-text table-responsive'>
                    <thead>
                        <tr>
                            <th class='table-smal-text'>DESCRIÇÃO</th>
                            <th class='table-smal-text'>JAN</th>
                            <th class='table-smal-text'>FEV</th>
                            <th class='table-smal-text'>MAR</th>
                            <th class='table-smal-text'>ABR</th>
                            <th class='table-smal-text'>MAI</th>
                            <th class='table-smal-text'>JUN</th>
                            <th class='table-smal-text'>JUL</th>
                            <th class='table-smal-text'>AGO</th>
                            <th class='table-smal-text'>SET</th>
                            <th class='table-smal-text'>OUT</th>
                            <th class='table-smal-text'>NOV</th>
                            <th class='table-smal-text'>DEZ</th>
                            <th class='table-smal-text'>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach($tipoReceita as $tr)
                        <tr>
                            <td>{{$tr->TR_CODIGO}} - {{$tr->TR_DESCRICAO}}</td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECJAN as $rjan)
                                @if($tr->TR_CODIGO==$rjan->COD)
                                R$ {{number_format($rjan->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECFEV as $rfev)
                                @if($tr->TR_CODIGO==$rfev->COD)
                                R$ {{number_format($rfev->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECMAR as $rmar)
                                @if($tr->TR_CODIGO==$rmar->COD)
                                R$ {{number_format($rmar->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECABR as $rabr)
                                @if($tr->TR_CODIGO==$rabr->COD)
                                R$ {{number_format($rabr->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECMAI as $rmai)
                                @if($tr->TR_CODIGO==$rmai->COD)
                                R$ {{number_format($rmai->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECJUN as $rjun)
                                @if($tr->TR_CODIGO==$rjun->COD)
                                R$ {{number_format($rjun->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECJUL as $rjul)
                                @if($tr->TR_CODIGO==$rjul->COD)
                                R$ {{number_format($rjul->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECAGO as $rago)
                                @if($tr->TR_CODIGO==$rago->COD)
                                R$ {{number_format($rago->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECSET as $rset)
                                @if($tr->TR_CODIGO==$rset->COD)
                                R$ {{number_format($rset->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECOUT as $rout)
                                @if($tr->TR_CODIGO==$rout->COD)
                                R$ {{number_format($rout->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECNOV as $rnov)
                                @if($tr->TR_CODIGO==$rnov->COD)
                                R$ {{number_format($rnov->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECDEZ as $rdez)
                                @if($tr->TR_CODIGO==$rdez->COD)
                                R$ {{number_format($rdez->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($RECTOTAL as $rtotal)
                                @if($tr->TR_CODIGO==$rtotal->COD)
                                R$ {{number_format($rtotal->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box'>
            <h5>PAGAMENTOS</h5>
            <div class="table-responsive">
                <table class='table table-striped table-bordered table-smal-text table-responsive'>
                    <thead>
                        <tr>
                            <th class='table-smal-text'>DESCRIÇÃO</th>
                            <th class='table-smal-text'>JAN</th>
                            <th class='table-smal-text'>FEV</th>
                            <th class='table-smal-text'>MAR</th>
                            <th class='table-smal-text'>ABR</th>
                            <th class='table-smal-text'>MAI</th>
                            <th class='table-smal-text'>JUN</th>
                            <th class='table-smal-text'>JUL</th>
                            <th class='table-smal-text'>AGO</th>
                            <th class='table-smal-text'>SET</th>
                            <th class='table-smal-text'>OUT</th>
                            <th class='table-smal-text'>NOV</th>
                            <th class='table-smal-text'>DEZ</th>
                            <th class='table-smal-text'>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach($tipoDebito as $td)
                        <tr>
                            <td>{{$td->TD_CODIGO}} - {{$td->TD_DESCRICAO}}</td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBJAN as $djan)
                                @if($td->TD_CODIGO==$djan->COD)
                                R$ {{number_format($djan->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBFEV as $dfev)
                                @if($td->TD_CODIGO==$dfev->COD)
                                R$ {{number_format($dfev->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBMAR as $dmar)
                                @if($td->TD_CODIGO==$dmar->COD)
                                R$ {{number_format($dmar->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBABR as $dabr)
                                @if($td->TD_CODIGO==$dabr->COD)
                                R$ {{number_format($dabr->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBMAI as $dmai)
                                @if($td->TD_CODIGO==$dmai->COD)
                                R$ {{number_format($dmai->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBJUN as $djun)
                                @if($td->TD_CODIGO==$djun->COD)
                                R$ {{number_format($djun->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBJUL as $djul)
                                @if($td->TD_CODIGO==$djul->COD)
                                R$ {{number_format($djul->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBAGO as $dago)
                                @if($td->TD_CODIGO==$dago->COD)
                                R$ {{number_format($dago->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBSET as $dset)
                                @if($td->TD_CODIGO==$dset->COD)
                                R$ {{number_format($dset->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBOUT as $dout)
                                @if($td->TD_CODIGO==$dout->COD)
                                R$ {{number_format($dout->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBNOV as $dnov)
                                @if($td->TD_CODIGO==$dnov->COD)
                                R$ {{number_format($dnov->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBDEZ as $ddez)
                                @if($td->TD_CODIGO==$ddez->COD)
                                R$ {{number_format($ddez->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                            <td class='table-smal-text' style='text-align: right'>
                                @foreach($DEBTOTAL as $dtotal)
                                @if($td->TD_CODIGO==$dtotal->COD)
                                R$ {{number_format($dtotal->TOTAL,2)}}
                                @endif
                                @endforeach
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>








    @push('css')
    @endpush

    @push('js-topo')
    @endpush

    @push('js-footer')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        @foreach($tipoReceita as $tr)
            @foreach($RECTOTAL as $rtotal)
                @if($tr->TR_CODIGO==$rtotal->COD)
                    @php $totalReceita = $rtotal->TOTAL @endphp
                @endif
            @endforeach
            
        ['{{$tr->TR_DESCRICAO}}', @if(isset($totalReceita)) {{$totalReceita}} @endif ],
        
        @endforeach
    ]);


    var options = {
        is3D: true,
        chartArea:{width:'100%',height:'80%'},
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart-receitas'));
    chart.draw(data, options);
    
    
    
    
    
    var data1 = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        @foreach($tipoDebito as $td)
            @foreach($DEBTOTAL as $dtotal)
                @if($td->TD_CODIGO==$dtotal->COD)
                    @php $totalDebito = $dtotal->TOTAL @endphp
                @endif
            @endforeach
            
        ['{{$td->TD_DESCRICAO}}', @if(isset($totalDebito)) {{$totalDebito}} @endif ],
        @endforeach
    ]);

        var options = {
            is3D: true,
            chartArea:{width:'100%',height:'80%'},
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart-debitos'));
        chart.draw(data1, options);
    
    }
    </script>
    
    @endpush

    @endsection