@extends('layouts.restrito')
@section('content')

<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li> <a href='{{url('/restrito/usuario')}}'>USUÁRIOS</a> </li>
                        <li class='active'>Perfil</li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>Permissões dos Perfis | <small>Gerenciamento de Registros</small></h4>
        </div>
    </div>
</div>



<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered'>
                                <thead>
                    <tr>
                        <th width='25px'>#</th>
                        <th>Nome</th>
                        <th width='70px'></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->id}}</td>
                        <td>
                             <b>Perfil: </b>{{$registro->name}} 
                             <br/>
                             <br/>
                            
                            <b>Permissões pra este perfil: </b> <br/>
                            @foreach($permission_role->all() as $permrole)
                                @if( $registro->id == $permrole->prRoleId)
                                    <div class="btn-group margin-inline" aria-label="" role="group">
                                        <button type="button" class="btn btn-xs btn-danger">
                                            {{$permrole->namePerm}}
                                        </button>
                                        <button type="button" class="btn btn-xs btn-danger" onclick="deletar('{{url("/restrito/permissao-perfil/deletar/$permrole->idpr")}}')" id='urlDeletar' >
                                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                            <br/>
                        </td>
                        <td>
                            <a href='#' onclick="edit('{{url("/restrito/permissao-perfil/cadastrar/$registro->id")}}')" 
                               class='btn btn-xs btn-default btn-warning'>
                                <i class="fa fa-minus-circle" aria-hidden="true"></i> Permissões
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan='4'>Nenhum dado inserido até o momento</td></tr>
                    @endforelse
                </tbody>
                
                
                
                
            </table>
        </div>
    </div>
</div>


<div class='modal fade modal-size-large' id='modalForm' tabindex='-1' role='dialog' aria-labelledby='' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                <h4 class='modal-title' id='myModalLabel'>{{$registro->id}} - TIPOS DE PERMISSÕES | <small>Gerenciamento de Registros</small></h4>
            </div>
            <div class='modal-body'>
                <form method='POST' action="{{url('/restrito/permissao-perfil/cadastrar')}}" id='form' 
                      class='bottom-margin' form-send="{{url('/restrito/permissao-perfil/cadastrar')}}">
                    {{csrf_field()}}
                    <fieldset>
                        <div class='row'>
                            <div class="col-lg-12">
                                <label>PERMISSÕES</label>
                                <div class="margin-bottom-30">
                                    <select name='permission_id' class='form-control' required>
                                        <option value=""> </option>
                                        @forelse($permissions as $permission)
                                        <option value="{{$permission->permissionsId}}" >
                                            <b>{{$permission->permissionsName}} - </b> {{$permission->permissionsLabel}} 
                                        </option>
                                        @empty
                                        <option>não há registros</option>
                                        @endforelse
                                    </select>
                                    <span class='color-danger' id='label-error-SUB_CODIGO' style='display: none;'></span>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class='modal-footer'>
                            <button type='submit' class='btn btn-success'><i class='fa fa-ok'></i> Salvar Dados</button>
                            <button type='reset' class='btn btn-default'>Limpar Campos</button>
                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css')
@endpush
@push('js')
@endpush
