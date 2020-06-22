@extends('layouts.restrito')
@section('content')

<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'>Permissões</li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>Tipos de Permissões | <small>Gerenciamento de Registros</small></h4>
        </div>
    </div>
</div>




<div id='thingy'>
    <button type='button' class='btn btn-xs btn-default btn-primary add' data-toggle='modal' data-target='#modalForm' onclick="erase()">
        Novo Registro
    </button>
</div>


<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th width='25px'>#</th>
                        <th width='160px'>Nome</th>
                        <th>Descrição</th>
                        <th width='70px'></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->id}}</td>
                        <td>{{$registro->name}}</td>
                        <td>{{$registro->label}}</td>

                        <td>
                            <a href='#' class='btn btn-xs waves-effect btn-danger'
                               onclick="deletar('{{url("/restrito/permissao/deletar/$registro->id")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='#' class='btn btn-xs waves-effect btn-success'
                               onclick="edit('{{url("/restrito/permissao/editar/$registro->id")}}')" id='edit'>
                                <i class='fa fa-pencil'></i>
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
                <h4 class='modal-title' id='myModalLabel'>TIPOS DE PERMISSÕES | <small>Gerenciamento de Registros</small></h4>
            </div>
            <div class='modal-body'>

                <form method='POST' action="{{url('/restrito/permissao/cadastrar')}}" id='form' 
                      class='bottom-margin' form-send="{{url('/restrito/permissao/cadastrar')}}">
                    {{csrf_field()}}
                    <fieldset>
                        <div class='row'>
                            <div class='form-group col-md-3'>
                                <label>*NOME</label>
                                <input type='text' name='name' id='name' class='form-control toUpper'
                                       maxlength='50' value="{{$data->name or old('name')}}" required autofocus />
                                <span class='color-danger' id='label-error-name' style='display: none;'></span>
                            </div>
                            <div class='form-group col-md-9'>
                                <label>*DESCRIÇÃO</label>
                                <input type='text' name='label' id='label' class='form-control toUpper' 
                                       value="{{$data->label or old('label')}}" required autofocus />
                                <span class='color-danger' id='label-error-label' style='display: none;'></span>
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