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

<div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <i class="mdi mdi-information"></i>
    <strong>CARO MINISTRO,</strong> algumas contribuições podem demorar um pequeno intervalo para que sejam lançadas no sistema. 
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            {!! Form::open(['url' => '/restrito/minhas-contribuicoes-cadastrar', 'method' => 'POST', 'class' => 'form-horizontal', 
            'enctype'=>'multipart/form-data', 'form-send'=> 'restrito/minhas-contribuicoes/cadastrar' ]) !!}
            @include('restrito.minhas-contribuicoes._form')
            {!! Form::close() !!} 
        </div>
    </div>
</div>

@push('css')
@endpush

@push('js-topo')
@endpush

@push('js-footer')

<script>
    $('#btnNewItem').click(function () {
        var row = $('table tbody > tr:last'),
                newRow = row.clone(),
                length = $("table tbody tr").length;

        newRow.find('td').each(function () {
            var td = $(this),
                    input = td.find('input,select,date'),
                    name = input.attr('name');
            input.attr('name', name.replace((length - 1) + "", length + ""));
        });

        newRow.find('input').val(1);
        newRow.insertAfter(row);
        calculateTotal();
    });

    (function ($) {
        remove = function (item) {
            var tr = $(item).closest('tr');
            tr.fadeOut(400, function () {
                tr.remove();
            });
            return false;
        }
    })(jQuery);


    $(document.body).on('blur', 'input', function () {
        calculateTotal();
    });

    $('input[name*=REC_VALOR]').blur(function () {
        calculateTotal();
    });

    function calculateTotal() {
        var total = 0,
                trlen = $('table tbody tr').length,
                tr = null, price;
        for (var i = 0; i < trlen; i++) {
            tr = $('table tbody tr').eq(i);
            price = tr.find('#REC_VALOR').val();
            total += parseFloat(price);
        }
        $('#total').html(total.toFixed(2));
    }
</script>


@endpush

@endsection