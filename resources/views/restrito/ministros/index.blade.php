@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'> <a href='{{url('/restrito/ministros')}}'>MINISTROS</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>MINISTROS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<a href='{{url("/restrito/ministros/cadastrar")}}' class='btn btn-primary waves-effect waves-light'>Novo Registro</a>
<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        
                        <th  width='20px'></th>
                        <th>NOME</th>
                        <th width='100px'>CPF</th>
                        <th width='20px'></th>
                        <th width='20px'></th>
                        <th width='20px'></th>
                        <th width='20px'></th>
                        <th width='60px'>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td style='text-align: center'>
                            <a href='#' 
                               onclick="fot('{{url("/restrito/users/foto/$registro->id")}}')" id='foto'>
                                @if(isset($registro->foto) && $registro->foto!='' && $registro->foto!=null)
                                <img src='{{url("/assets/users/$registro->foto")}}' 
                                     alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                @else
                                <img src='{{url("/assets/users/not_img.jpg")}}' 
                                     alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                                @endif
                            </a>
                        </td>
                        <td>
                            {{$registro->DEM_ATIVIDADE}} {{$registro->name}}<br/>
                            MATRÍCULA {{$registro->matricula}}<br/>
                            {{$registro->CID_NOME}}/{{$registro->CID_UF}}

                        </td>
                        <td>{{$registro->cpf}}</td>
                        <!-- ENDEREÇO -->
                        <td style='text-align: center'>
                            @if(isset($registro->END_CODIGO))
                            <a href='{{url("/restrito/ministros/endereco/editar/$registro->END_CODIGO")}}'
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
                            <a href='{{url("/restrito/ministros/endereco/cadastrar/$registro->id")}}' 
                               class='btn btn-xs btn-primary waves-effect waves-light tooltip-hover'  
                               title='Adicionar o endereço' >
                                <i class='mdi mdi-map-marker-plus'></i>
                            </a>
                            @endif
                        </td>
                        <!--DADOS ECLESIASTICOS-->
                        <td style='text-align: center'>
                            @if(isset($registro->DEM_CODIGO))
                            <a href='{{url("/restrito/ministros/dados-eclesiasticos/editar/$registro->DEM_CODIGO")}}'
                               class='btn btn-xs btn-success waves-effect waves-light tooltip-hover' title='Alterar Dados Eclesiásticos' >
                                <i class='mdi mdi-church'></i> 
                            </a>
                            @else
                            <a href='{{url("/restrito/ministros/dados-eclesiasticos/cadastrar/$registro->id")}}'
                               class='btn btn-xs btn-primary waves-effect waves-light tooltip-hover' title='Adicionar Dados Eclesiásticos' >
                                <i class='mdi mdi-church'></i> 
                            </a>
                            @endif
                        </td>
                        <!-- DEPENDENTES -->
                        <td style='text-align: center'>
                            <a href='{{url("/restrito/ministros/dependentes/$registro->id")}}'
                               class='btn btn-xs btn-brown waves-effect waves-light tooltip-hover' title='Dependentes' >
                                <i class='mdi mdi-account-star'></i>
                            </a>
                        </td>
                        <!-- DADOS BANCÁRIOS -->
                        <td style='text-align: center'>
                            @if(isset($registro->BAN_CODIGO))
                            <a href='{{url("/restrito/ministros/dados-bancarios/editar/$registro->BAN_CODIGO")}}' 
                               class='btn btn-xs btn-success waves-effect waves-light tooltip-hover'
                               title='Alterar Dados Bancários' >
                                <i class='mdi mdi-cash-multiple'></i> 
                            </a>
                            @else
                            <a href='{{url("/restrito/ministros/dados-bancarios/cadastrar/$registro->id")}}'
                               class='btn btn-xs btn-primary waves-effect waves-light tooltip-hover' 
                               title='Adicionar Dados Bancários' >
                                <i class='mdi mdi-cash-multiple'></i>
                            </a>
                            @endif
                        </td>
                        <!-- BOTÕES DE INTERAÇÃO -->
                        <td>
                            <a href='{{url("/restrito/ministros/view/$registro->id")}}' 
                               class='btn btn-xs waves-effect btn-default tooltip-hover' title='Visualizar Ficha'>
                                <i class='fa fa-file-text-o'></i>
                            </a>
                            <a href='#' class='btn btn-xs waves-effect btn-danger tooltip-hover' title='Excluir registro' 
                               onclick="deletar('{{url("/restrito/ministros/deletar/$registro->id")}}')" id='urlDeletar' >
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='{{url("/restrito/ministros/editar/$registro->id")}}' 
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

<div id='modalFormFoto' class='modal fade' role='dialog' aria-labelledby='full-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <form method='POST' action='{{url('/restrito/users/foto')}}' id='formFoto' class='form-horizontal' 
                  form-send='SALVAR-FOTO' role='form' enctype='multipart/form-data'>
                {{csrf_field()}}
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                    <h4>FOTO | <span class='small-text text-lighten-1'>Inserir Imagem</span></h4>
                </div>
                <div class='modal-body'>
                    <div class='row manager'>
                        <div class='input-field col-md-12'>
                            <label for='foto'>ESCOLHA A IMAGEM</label>
                            <br/>
                            <br/>
                            {!! Form::hidden('id', null, ['class' => 'form-control', 'required' => 'yes' ]) !!}
                            {!! Form::file('foto', ['class' => 'form-control primary','required' => 'yes']) !!}
                            <span class='text-danger' id='label-error-foto' style='display: none;'></span>
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
                    <button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Fechar</button>
                    <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>
                </div>
            </form>
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