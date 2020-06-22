@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/lixeira/usuarios')}}'>USUÁRIOS DELETADOS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>USUÁRIOS DELETADOS | <small>RECUPERAÇÃO E EXCLUSÃO DEFINITIVA</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th  width='20px'></th>
                        <th width='50px'>MATR.</th>
                        <th width='70px'>ATIVIDE</th>
                        <th>NOME</th>
                        <th>CONJUGE</th>
                        <th>EMAIL</th>
                        <th width='100px'>CPF</th>
                        <th width='70px'>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td style='text-align: center'>
                            <a href='#' id='foto'>
                                @if(isset($registro->foto) && $registro->foto!='' && $registro->foto!=null)
                                <img src='{{url("/assets/users/$registro->foto")}}' 
                                     alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                @else
                                <img src='{{url("/assets/users/not_img.jpg")}}' 
                                     alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                @endif
                            </a>
                        </td>
                        <td>{{$registro->matricula}}</td>
                        <td>
                            @if($registro->tp == 'MIN')
                                MINISTRO
                            @else
                                MISSIONÁRIA
                            @endif
                        </td>
                        <td>{{$registro->name}}</td>
                        <td>{{$registro->conjuge}}</td>
                        <td>{{$registro->email}}</td>
                        <td>{{$registro->cpf}}</td>

                        
                        
                        

                        <td>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir registro Permanente' 
                               onclick="deletar('{{url("/restrito/lixeira/usuarios/deletar/$registro->id")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='#' class='btn btn-xs waves-effect btn-success tooltip-hover' title='Restaurar registro'
                               onclick="edit('{{url("/restrito/lixeira/usuarios/restaurar/$registro->id")}}')" >
                                <i class='fa fa-recycle'></i>
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