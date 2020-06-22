@extends('layouts.restrito')
@section('content')

<div class='row'>&nbsp</div>
<div class='row'>
    @forelse($debitosAberto as $debitoAberto)
    <div class="col-lg-3 col-md-6">
        <div class="card-box tilebox-two tilebox-success">
            <i class="mdi mdi-currency-usd pull-right text-dark"></i>
            <h6 class="text-success text-uppercase m-b-15 m-t-10">Mensalidade em aberto</h6>
            <h2 class="m-b-10">
                R$
                <span data-plugin="counterup">
                    <?php
                    $valorAtual = $debitoAberto->valor;
                    echo number_format($valorAtual, 2);
                    ?>
                </span>
            </h2>
        </div>
    </div>
    @empty
    @endforelse

    @forelse($debitosAtraso as $debitoAtraso)
    <div class="col-lg-3 col-md-6">
        <div class="card-box tilebox-two tilebox-danger">
            <i class="mdi mdi-currency-usd pull-right text-dark"></i>
            <h6 class="text-danger text-uppercase m-b-15 m-t-10">Mensalidade em atraso</h6>
            <h2 class="m-b-10">
                R$
                <span data-plugin="counterup">
                    <?php
                    $valorAtual = $debitoAtraso->valor;
                    echo number_format($valorAtual, 2);
                    ?>
                </span>
            </h2>
        </div>
    </div>
    @empty
    @endforelse


    <div class='col-lg-3 col-md-6'>
        <div class='card-box widget-box-two widget-two-info'>
            <i class='mdi mdi-calendar-clock widget-two-icon'></i>
            <div class='wigdet-two-content text-white'>
                <p class='m-0 text-uppercase font-600 font-secondary text-overflow'>Assembleia Ordinária</p>
                
                @foreach($agos as $ago)
                    @php $dataHJ = date('Y-m-d'); @endphp
                    @if($dataHJ <= $ago->EVEN_DTINICIO)
                        <h2 class='text-white'><span data-plugin='counterup'>
                                 DE {{ \Carbon\Carbon::parse($ago->EVEN_DTINICIO)->format('d/m')}}
                            a {{ \Carbon\Carbon::parse($ago->EVEN_DTFINAL)->format('d/m/Y')}}
                            
                            </span> </h2>
                        <p class='m-0 text-uppercase font-600 font-secondary text-overflow'>{{$ago->EVEN_LOCAL}}</p>
                    @else
                        <h2 class='text-white'><span data-plugin='counterup'></span> </h2>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-6'>
        <div class='card-box widget-box-two widget-two-danger'>
            <i class='mdi mdi-calendar-clock widget-two-icon'></i>
            <div class='wigdet-two-content text-white'>
                <p class='m-0 text-uppercase font-600 font-secondary text-overflow'>Assembleia Extraordinária</p>
                
                @foreach($ages as $age)
                    @php $dataHJ = date('Y-m-d'); @endphp
                    @if($age->EVEN_DTINICIO != null && $dataHJ <= $age->EVEN_DTINICIO)
                    <h2 class='text-white'><span data-plugin='counterup'>
                            DE {{ \Carbon\Carbon::parse($age->EVEN_DTINICIO)->format('d/m')}}
                            a {{ \Carbon\Carbon::parse($age->EVEN_DTFINAL)->format('d/m/Y')}}
                        </span> </h2>
                    
                        <p class='m-0 text-uppercase font-600 font-secondary text-overflow'>{{$age->EVEN_LOCAL}}</p>
                    @else
                        <h2 class='text-white'><span data-plugin='counterup'> ...</span> </h2>
                    @endif
                @endforeach
               
            </div>
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
<!-- end row -->

<div class='row'>&nbsp</div>





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
    
<!-- Flot chart js -->
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.min.js')}}'></script>
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.time.js')}}'></script>
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.tooltip.min.js')}}'></script>
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.resize.js')}}'></script>
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.pie.js')}}'></script>
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.selection.js')}}'></script>
<script src='{{url('/assets/plugins/flot-chart/jquery.flot.crosshair.js')}}'></script>

<script src='{{url('/assets/plugins/moment/moment.js')}}'></script>
<script src='{{url('/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}'></script>

<!-- Dashboard init -->
<script src='{{url('/assets/pages/jquery.dashboard_2.js')}}'></script>
@endpush

@endsection

