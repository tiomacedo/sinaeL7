@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active text-uppercase'><a href='{{url("/restrito/$tipo")}}'>{{$tipo}}</a></li>
                    </ol>
                </h4>
            </div>
            @if(isset($conjuge))
            <h4 class='page-title'>DEPENDENTES DE
                <span class="label label-default text-uppercase">{{$nome}}</span> & <span class="label label-default text-uppercase"> {{$conjuge}}</span></h4>
            @else
            <h4 class='page-title'>DEPENDENTES DE
                <span class="label label-default text-uppercase">{{$nome}}</span> </h4>
            @endif
        </div>
    </div>
</div>

<a href='{{url("/restrito/$tipo/dependentes/cadastrar/$id")}}' 
   class='btn btn-primary waves-effect waves-light'>Novo Registro</a>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th width='180px'>GRAU PARENTESCO</th>
                        <th width='100px'>DT. NASC</th>
                        <th width='50px'>#</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($data as $dependente)
                    <tr>
                        <td>{{$dependente->DEP_NOME}} </td>
                        <td>{{$dependente->DEP_GRAUPARENTESCO}}</td>
                        <td>{{ \Carbon\Carbon::parse($dependente->DEP_DATANASCIMENTO)->format('d/m/Y')}}</td>
                        <td>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir registro' 
                               onclick="deletar('{{url("/restrito/$tipo/dependentes/deletar/$dependente->DEP_CODIGO")}}')" 
                               id='urlDeletar' >
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/$tipo/dependentes/editar/$dependente->DEP_CODIGO")}}' 
                               class='btn btn-xs waves-effect btn-success tooltip-hover' title='Editar' >
                                <i class='fa fa-pencil'></i>
                            </a>
                        </td>
                    </tr>
                    @empty
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