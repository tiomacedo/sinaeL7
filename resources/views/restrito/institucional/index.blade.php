@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/institucional')}}'>DADOS INSTITUCIONAIS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>DADOS INSTITUCIONAIS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            @foreach($data as $registro)
            <table class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th>NOME FANTASIA</th>
                        <th>RAZAO SOCIAL</th>
                        <th>INSCR. MUNICIPAL</th>
                        <th>INSCR. ESTADUAL</th>
                        <th>DI_CNPJ</th>
                    </tr>
                </thead>
                <tbody>
                <td>{{$registro->DI_NOMEFANTASIA}}</td>
                <td>{{$registro->DI_RAZAOSOCIAL}}</td>
                <td>{{$registro->DI_INSCRICAOMUNICIPAL}}</td>
                <td>{{$registro->DI_INSCRICAOESTADUAL}}</td>
                <td>{{$registro->DI_CNPJ}}</td>

                </tbody>            

                <thead>
                    <tr>
                        <th colspan='2'>ENDEREÇO</th>
                        <th>CIDADE</th>
                        <th>FONE</th>
                        <th>MENSALIDADE R$</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan='2'>{{$registro->DI_ENDERECO}} - {{$registro->DI_CEP}}</td>
                        <td>{{$registro->DI_CIDADE}}/{{$registro->DI_UF}}</td>
                        <td>{{$registro->DI_FONE}}</td>
                        <td>R$ {{number_format($registro->DI_MENSALIDADE,2)}}</td>
                    </tr>
                </tbody>
            </table>


            <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="mdi mdi-information"></i>
                <strong>A PARTIR DAQUI, O PREENCHIMENTO SÓ É NECESSÁRIO QUANDO SE CRIAR A EMISSÃO DE TAXAS VIA BOLETOS</strong>
            </div>

            <table class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th>AGÊNCIA</th>
                        <th>CONTA</th>
                        <th>MULTA</th>
                        <th>JUROS</th>
                        <th>JUROSAPOS</th>
                        <th>DIAS PROT.</th>
                        <th>CARTEIRA</th>
                        <th>CONVENIO</th>
                        <th>VAR .CART.</th>
                        <th>RANGE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$registro->DI_AGENCIA}}-{{$registro->DI_AGENCIA_DV}}</td>
                        <td>{{$registro->DI_CONTA}}-{{$registro->DI_CONTA_DV}}</td>
                        <td>{{$registro->DI_MULTA}}</td>
                        <td>{{$registro->DI_JUROS}}</td>
                        <td>{{$registro->DI_JUROSAPOS}}</td>
                        <td>{{$registro->DI_DIASPROTESTO}}</td>
                        <td>{{$registro->DI_CARTEIRA}}</td>
                        <td>{{$registro->DI_CONVENIO}}</td>
                        <td>{{$registro->DI_VARIACAOCARTEIRA}}</td>
                        <td>{{$registro->DI_RANGE}}</td>
                    </tr>
                </tbody>
            </table>

            <table class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th>COD. CLIENTE</th>
                        <th>ESP. DOC</th>
                        <th>ACEITE</th>
                        <th>MENSAGEM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$registro->DI_CODIGOCLIENTE}}</td>
                        <td>{{$registro->DI_ESPECIEDOC}}</td>                                                                                                                                                            >
                        <td>{{$registro->DI_ACEITE}}</td>                                                                                                                                                            >
                        <td>{{$registro->DI_MENSAGEM1}}</td>  
                    </tr>
                </tbody>

            </table>

            <table class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th>INSTRUÇÃO1</th>
                        <th>INSTRUÇÃO2</th>
                        <th>INSTRUÇÃO3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$registro->DI_INSTRUCAO1}}</td>
                        <td>{{$registro->DI_INSTRUCAO2}}</td>                                                                                                                                                            >
                        <td>{{$registro->DI_INSTRUCAO3}}</td>                                                                                                                                                           >
                    </tr>
                    <tr>
                        <td colspan='20'>
                            <a href='{{url("/restrito/institucional/editar/$registro->DI_CODIGO")}}' 
                               class='btn btn-success waves-effect waves-light tooltip-hover' title='Editar'>
                                <i class='fa fa-pencil'></i> EDITAR
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @endforeach
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