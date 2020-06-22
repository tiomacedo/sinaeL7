@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/minha-area/igrejas')}}'>IGREJAS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>IGREJAS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th width='20'>#</th>
                        <th width='50px'>ÁREA</th>
                        <th>PASTOR PRESIDENTE</th>
                        <th width='260px'>IGREJA</th>
                        <th width='90px'>FONE</th>
                        <th width='90px'>CELULAR</th>
                        <th width='40px'>ENDEREÇO</th>
                        <th width='40px'>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->IGRCODIGO}}</td>
                        <td>{{$registro->ARE_CODIGOMANUAL}}</td>
                        <td>
                            {{$registro->IGR_RESPONSAVEL}}
                        </td>
                        <td>{{$registro->IGR_MATRICULA}} - {{$registro->IGR_NOMECONGRECACAO}}</td>
                        <td>{{$registro->IGR_FONE}}</td>
                        <td>{{$registro->IGR_CELULAR}}</td>
                        <!-- ENDEREÇO -->
                        <td style='text-align: center'>
                            @if(isset($registro->END_CODIGO))
                            <a href='{{url("/restrito/minha-area/igrejas/enderecos/editar/$registro->END_CODIGO")}}'
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
                            <a href='{{url("/restrito/minha-area/igrejas/enderecos/cadastrar/$registro->IGRCODIGO")}}' 
                               class='btn btn-xs btn-primary waves-effect waves-light tooltip-hover'  
                               title='Adicionar o endereço' >
                                <i class='mdi mdi-map-marker-plus'></i>
                            </a>
                            @endif
                        </td>
                        <td>
                            <a href='{{url("/restrito/minha-area/igrejas/editar/$registro->IGRCODIGO")}}' 
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


<div id='modalFormEndereco' class='modal fade' role='dialog' aria-labelledby='full-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog modal-full'>
        <div class='modal-content'>
            <form method='POST' action='SALVAR-ENDERECO' id='formEndereco' class='form-horizontal' form-send='SALVAR-ENDERECO' role='form'>
                {{csrf_field()}}
                {!! Form::hidden('IGR_CODIGO', null, ['class' => '', 'required' => 'yes' ]) !!}
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                    <h4>ENDEREÇO | <span class='small-text text-lighten-1'>Formulário de Gerenciamento</span></h4>
                </div>
                <div class='modal-body'>
                    <div class='row manager'>
                        <div class='input-field col-md-2'>
                            <label for='END_CEP'>CEP</label>
                            {!! Form::text('END_CEP', null, ['data-mask' => '99.999-999', 'min' => '10', 'maxlength' => '10', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-END_CEP' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-5'>
                            <label for='END_LOGRADOURO'>ENDEREÇO</label>
                            {!! Form::text('END_LOGRADOURO', null, ['min' => '0', 'maxlength' => '100', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-END_CEP' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-2'>
                            <label for='END_LOGRADOURO'>ENDEREÇO</label>
                            {{ Form::select('END_TIPOLOGRADOURO', [
                                    'CASA' => 'CASA', 
                                    'APARTAMENTO' => 'APARTAMENTO', 
                                    'SALA' => 'SALA', 
                                    'LOTE' => 'LOTE'
                        ], null, ['class' => 'form-control'])
                            }}
                            <span class='color-danger' id='label-error-END_TIPOLOGRADOURO' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-1'>
                            <label for='END_NUMERO'>Nº</label>
                            {!! Form::text('END_NUMERO', null, ['min' => '', 'maxlength' => '7', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-END_NUMERO' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-2'>
                            <label for='END_COMPLEMENTO'>COMPLEMENTO</label>
                            {!! Form::text('END_COMPLEMENTO', null, ['min' => '', 'maxlength' => '20', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                            <span class='color-danger' id='label-error-END_CIDADE' style='display: none;'></span>
                        </div>
                    </div>
                    <div class='row manager'>
                        <div class='input-field col-md-4'>
                            <label for='END_BAIRRO'>BAIRRO</label>
                            {!! Form::text('END_BAIRRO', null, ['maxlength' => '50', 'class' => 'form-control', 'style' => 'text-transform: uppercase']) !!}
                            <span class='color-danger' id='label-error-END_BAIRRO' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-4'>
                            <label for='END_CIDADE'>CIDADE</label>
                            {!! Form::text('END_CIDADE', null, ['min' => '4', 'maxlength' => '100', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-END_CIDADE' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-1'>
                            <label for='END_UF'>UF</label>
                            {!! Form::text('END_UF', null, ['min' => '2', 'maxlength' => '2', 'class' => 'form-control', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                            <span class='color-danger' id='label-error-END_CIDADE' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-3'>
                            <label for='END_DESCRICAOERRO'>
                                MOTIVO DEVOLUÇÃO
                            </label>
                            {!! Form::text('END_DESCRICAOERRO', null, ['maxlength' => '200', 'class' => 'form-control', 'style' => 'text-transform: uppercase',]) !!}
                            <span class='color-danger' id='label-error-END_DESCRICAOERRO' style='display: none;'></span>
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



<div id='modalFormFicha' class='modal fade' role='dialog' aria-labelledby='full-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog modal-full'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                <h4>IGREJA | <span class='small-text text-lighten-1'></span></h4>
            </div>
            <div class='modal-body'>
                <div class='row manager'>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_ARE_CODIGOMANUAL'>Área</label>
                        <br/>
                        <span id='SPAN_ARE_CODIGOMANUAL'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        <label for='SPAN_IGR_NOMECONGRECACAO'>Congregação</label>
                        <br/>
                        <span id='SPAN_IGR_NOMECONGRECACAO'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        <label for='SPAN_IGR_RESPONSAVEL'>Responsável</label>
                        <br/>
                        <span id='SPAN_IGR_RESPONSAVEL'></span>
                    </div>
                    <div class='input-field col-md-3'>
                        <label for='SPAN_IGR_CNPJ'>CNPJ</label>
                        <br/>
                        <span id='SPAN_IGR_CNPJ'></span>
                    </div>
                </div>
                <div class='row manager'>
                    <div class='input-field col-md-2'>
                        <label for='SPAN_IGR_TEMPLO'>Templo</label>
                        <br/>
                        <span id='SPAN_IGR_TEMPLO'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDMISSIONARIOS'>Nº Miss</label>
                        <br/>
                        <span id='SPAN_IGR_QTDMISSIONARIOS'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDDIACONOS'>Nº Diác</label>
                        <br/>
                        <span id='SPAN_IGR_QTDDIACONOS'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDPRESBITEROS'>Nº Presb</label>
                        <br/>
                        <span id='SPAN_IGR_QTDPRESBITEROS'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDEVANGELISTAS'>Nº Evan</label>
                        <br/>
                        <span id='SPAN_IGR_QTDEVANGELISTAS'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDPASTORES'>Nº Pr's</label>
                        <br/>
                        <span id='SPAN_IGR_QTDPASTORES'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDMEMBROS'>Membros</label>
                        <br/>
                        <span id='SPAN_IGR_QTDMEMBROS'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDELEITORESCIDADE'>Eleitores C</label>
                        <br/>
                        <span id='SPAN_IGR_QTDELEITORESCIDADE'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDELEITORESIGREJA'>Eleitores I</label>
                        <br/>
                        <span id='SPAN_IGR_QTDELEITORESIGREJA'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for='SPAN_IGR_QTDMEMBROSPOLITICOS'>Políticos</label>
                        <br/>
                        <span id='SPAN_IGR_QTDMEMBROSPOLITICOS'></span>
                    </div>
                    <div class='input-field  col-md-1'>
                        <label for='SPAN_IGR_QTDFUNCIONARIOSPUBLICOS'>Func. Púb</label>
                        <br/>
                        <span id='SPAN_IGR_QTDFUNCIONARIOSPUBLICOS'></span>
                    </div>
                </div>
                <div class='row manager divisory'>
                    <h3>ENDEREÇO</h3>
                    <div class='input-field col-md-2'>
                        <label for=''>CEP</label>
                        <br/>
                        <span id='SPAN_END_CEP'></span>
                    </div>
                    <div class='input-field col-md-5'>
                        <label for=''>LOGRADOURO</label>
                        <br/>
                        <span id='SPAN_END_LOGRADOURO' class='text-uppercase'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        <label for=''>TP LGDR</label>
                        <br/>
                        <span id='SPAN_END_TIPOLOGRADOURO' class='text-uppercase'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        <label for=''>Nº</label>
                        <br/>
                        <span id='SPAN_END_NUMERO' class='text-uppercase'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        <label for=''>COMPLEMENTO</label>
                        <br/>
                        <span id='SPAN_END_COMPLEMENTO' class='text-uppercase'></span>
                    </div>
                </div>
                <div class='row manager'>
                    <div class='input-field col-md-1'>
                        <label for=''>UF</label>
                        <br/>
                        <span id='SPAN_END_UF' class='text-uppercase'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        <label for=''>CIDADE</label>
                        <br/>
                        <span id='SPAN_END_CIDADE' class='text-uppercase'></span>
                    </div>
                    <div class='input-field col-md-3'>
                        <label for=''>BAIRRO</label>
                        <br/>
                        <span id='SPAN_END_BAIRRO' class='text-uppercase'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        <label for=''>DEV.</label>
                        <br/>
                        <span id='SPAN_END_DESCRICAOERRO' class='text-uppercase'></span>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Fechar</button>
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