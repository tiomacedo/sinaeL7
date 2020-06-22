@extends('layouts.restrito')
@section('content')

<?php if (isset($_REQUEST['emailEnviado'])) { ?>
    <div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="mdi mdi-check-all"></i>
        <strong>Sucesso no envio!</strong> O boleto foi enviado para o email do usuário cadastrado.
    </div>

<?php } ?>

<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'>BOLETOS GERADOS</li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>BOLETOS | <small>Gerenciamento de Registros</small></h4>
        </div>
    </div>
</div>


<a href='{{url('/restrito/receitas/gerar-boletos')}}' class='btn btn-primary waves-effect waves-light'>Novo Registro</a>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th width='5px'>#</th>
                        <th >DESCRIÇÃO</th>
                        <th width='50px'>VENC.</th>
                        <th width='50px'>PGTO.</th>
                        <th width='117px'>Nº DOCUMENTO</th>
                        <th width='50px'>R$</th>
                        <th width='90px'></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->REC_CODIGO}}</td>
                        <td>
                            <b>{{$registro->TR_DESCRICAO}} 
                                MÊS {{ \Carbon\Carbon::parse($registro->REC_DTREFERENCIA)->format('m/Y')}}
                            </b> 
                            - {{$registro->name}} 
                            - {{$registro->COMPLEMENTO}}
                        </td>


                        <td>
                            @if(isset($registro->REC_DTVENCIMENTO) && $registro->REC_DTVENCIMENTO!=null)
                            {{\Carbon\Carbon::parse($registro->REC_DTVENCIMENTO)->format('d/m/y')}}
                            @endif
                        </td>
                        <td>@if(isset($registro->REC_DTRECEBIMENTO) && $registro->REC_DTRECEBIMENTO!=null)
                            {{\Carbon\Carbon::parse($registro->REC_DTRECEBIMENTO)->format('d/m/y')}}
                            @endif
                        </td>
                        <td style='text-align: right'>{{$registro->REC_NOSSONUMERO}}</td>
                        <td style='text-align: right'>{{number_format($registro->REC_VALOR,2)}}</td>

                        <td style='text-align: right'>


                            <a href='{{url("/restrito/receitas/boletos/$registro->REC_CODIGO")}}' 
                               target='_blank' class='btn waves-effect btn-default btn-xs tooltip-hover' title='Visualizar'>
                                <i class='fa fa-barcode'></i>
                            </a>

                            @if(!isset($registro->REC_DTRECEBIMENTO) || $registro->REC_DTRECEBIMENTO==null)
                            <a href='{{url("/restrito/receitas/boletos/email/$registro->REC_CODIGO")}}' class='btn waves-effect btn-orange btn-xs tooltip-hover' title='Enviar por Email'>
                                <i class='fa fa-envelope'></i>
                            </a>
                            <a href='#' class='btn waves-effect btn-danger btn-xs tooltip-hover' title='Excluir'
                               onclick="deletar('{{url("/restrito/receitas/deletar/$registro->REC_CODIGO")}}')" id='urlDeletar'>
                                <i class='fa fa-trash'></i>
                            </a>
                            <a href='#' class='btn waves-effect btn-success btn-xs tooltip-hover' title='Baixar Fatura'
                               onclick="edit('{{url("/restrito/receitas/editar/$registro->REC_CODIGO")}}')" id='edit'>
                                <i class='fa fa-pencil'></i>
                            </a>
                            @endif
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






<div id='modalForm' class='modal fade' role='dialog' aria-labelledby='full-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog modal-full'>
        <div class='modal-content'>

            <form method='POST' action="{{url('/restrito/receitas/cadastrar')}}" id='form' role='form' 
                  class='form-horizontal' form-send="{{url('/restrito/receitas/cadastrar')}}">
                {{csrf_field()}}
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                    <h4>RECEITAS | <span class='small-text text-lighten-1'>Formulário de Gerenciamento</span></h4>
                    <h4><span class='small-text text-lighten-1 text-danger'>Insira somente dados do que já foi recebido</span></h4>
                </div>

                <div class='modal-body'>
                    <div class='row manager'>
                        <div class='input-field col-md-2'>
                            <label for='TR_CODIGO'>DESCRIÇÃO</label>
                            <select name='TR_CODIGO' id='TR_CODIGO' class="select2 form-control" required>
                                <option></option>
                                @forelse($tipos as $tipo)
                                <option value='{{$tipo->TR_CODIGO}}'>{{$tipo->TR_DESCRICAO}}</option>
                                @empty
                                <option value=''></option>
                                @endforelse
                            </select>
                            <span class='color-danger' id='label-error-TR_CODIGO' style='display: none;'></span>
                        </div>

                        <div class='input-field col-md-3'>
                            <label for='user_id'>USUÁRIO</label>
                            <select name='user_id' id='user_id' class='select2 form-control'>
                                <option></option>
                                @forelse($users as $user)
                                <option value='{{$user->id}}'>{{$user->name}}</option>
                                @empty
                                <option value=''></option>
                                @endforelse
                            </select>
                            <span class='color-danger' id='label-error-user_id' style='display: none;'></span>
                        </div>

                        <div class='input-field col-md-2'>
                            <label for='COMPLEMENTO'>COMPLEMENTO</label>
                            {!! Form::text('COMPLEMENTO', null, ['class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                            <span class='color-danger' id='label-error-COMPLEMENTO' style='display: none;'></span>
                        </div>

                        <div class='input-field col-md-2'>
                            <label for='REC_DTREFERENCIA'>DT. REFERÊNCIA</label>
                            {!! Form::date('REC_DTREFERENCIA', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-REC_DTREFERENCIA' style='display: none;'></span>
                        </div>

                        <div class='input-field col-md-2'>
                            <label for='REC_DTRECEBIMENTO'>DT. RECEBIMENTO</label>
                            {!! Form::date('REC_DTRECEBIMENTO', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-REC_DTRECEBIMENTO' style='display: none;'></span>
                        </div>

                        <div class='input-field col-md-1'>
                            <label for='REC_VALOR'>VALOR R$</label>
                            {!! Form::text('REC_VALOR', null, ['class' => 'form-control autonumber', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-REC_VALOR' style='display: none;'></span>
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
@endpush

@endsection