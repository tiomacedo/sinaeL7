@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/igrejas')}}'>IGREJAS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>IGREJAS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<a href='{{url("/restrito/igrejas/cadastrar")}}' class='btn btn-primary waves-effect waves-light'>Novo Registro</a>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>

                        <th width='50px'>ÁREA</th>
                        <th>PASTOR PRESIDENTE</th>
                        <th width='260px'>IGREJA</th>
                        <th width='90px'>FONE</th>
                        <th width='90px'>CELULAR</th>
                        <th>CIDADE</th>
                        <th width='40px'>END</th>
                        <th width='40px'>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>

                        <td>{{$registro->ARE_CODIGOMANUAL}}</td>
                        <td>
                            {{$registro->IGR_RESPONSAVEL}}
                        </td>
                        <td>{{$registro->IGR_MATRICULA}} - {{$registro->IGR_NOMECONGRECACAO}}</td>
                        <td>{{$registro->IGR_FONE}}</td>
                        <td>{{$registro->IGR_CELULAR}}</td>
                        <td>
                            {{$registro->CID_NOME}}-{{$registro->CID_UF}}
                            @if(isset($registro->END_BAIRRO) && $registro->END_BAIRRO!='')
                            <br/>
                            <p class='label label-brown small-text'> {{$registro->END_BAIRRO}} </p>
                            @endif
                        </td>
                        <td style='text-align: center'>
                            @if(isset($registro->END_CODIGO))
                            <a href='{{url("/restrito/igrejas/endereco/editar/$registro->END_CODIGO")}}'
                               title='Alterar endereço'

                               @if(isset($registro->END_DESCRICAOERRO) && $registro->END_DESCRICAOERRO!="")
                               class='btn btn-xs btn-warning waves-effect waves-light tooltip-hover'
                               @else
                               class='btn btn-xs btn-success waves-effect waves-light tooltip-hover'
                               @endif
                               >
                               <i class='mdi mdi-map-marker-radius'></i>
                            </a>
                            @else
                            <a href='{{url("/restrito/igrejas/endereco/cadastrar/$registro->IGRCODIGO")}}'
                               class='btn btn-xs btn-primary waves-effect waves-light tooltip-hover'
                               title='Adicionar o endereço' >
                                <i class='mdi mdi-map-marker-plus'></i>
                            </a>
                            @endif
                        </td>

                        <td style='text-align: right'>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir'
                               onclick="deletar('{{url("/restrito/igrejas/deletar/$registro->IGRCODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/igrejas/editar/$registro->IGRCODIGO")}}'
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