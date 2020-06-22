@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li> <a href='{{url('/restrito/receitas-tipo')}}'>MODALIDADES</a> </li>
                        <li class='active'>Gerar Boletos</li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>GERAR BOLETOS | <small>GERENCIAMENTO DOS REGISTROS</small></h4>
        </div>
    </div>
</div>


<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>


            <ul class="nav nav-tabs">

                <li class="active">
                    <a href="#mensalidade" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Mensalidade</span>
                    </a>
                </li>
                <li class="">
                    <a href="#unico" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">Gerar Boleto Único</span>
                    </a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="mensalidade">

                    <form method='POST' action="{{url('/restrito/receitas/gerar-boletos-mensalidade')}}" id='form' role='form' 
                          class='form-horizontal' form-send="{{url('/restrito/receitas/gerar-boletos-mensalidade')}}">
                        {{csrf_field()}}

                        {!! Form::hidden('REC_DTLANCAMENTO', \Carbon\Carbon::now()) !!}
                        <span class='color-danger' id='label-error-REC_NOSSONUMERO' style='display: none;'></span>



                        <div class='row manager'>
                            <div class='input-field col-md-6'>
                                <label for='user_id'>NOME(s) DO MINISTRO(s)</label>
                                <select name='user_id[]' id='user_id' class='select2 form-control select2-multiple' multiple='multiple' multiple required>
                                    <option value='TODOS'>TODOS OS MINISTROS</option>
                                    @forelse($users as $user)
                                    <option value='{{$user->id}}'>{{$user->name}}</option>
                                    @empty
                                    <option value=''></option>
                                    @endforelse
                                </select>
                                <span class='color-danger' id='label-error-user_id' style='display: none;'></span>
                            </div>


                            <div class='input-field col-md-2'>
                                <label for='REC_DTREFERENCIA' id='tooltip-hover' class='btn btn-danger' title='Preencha somente em caso da mensalidade ser referente um mês anterior.'>
                                    <i class=' mdi mdi-alert-circle text-danger'></i> MÊS DE REFERÊNCIA</label>
                                {!! Form::date('REC_DTREFERENCIA', null, ['class' => 'form-control']) !!}
                                <span class='color-danger' id='label-error-REC_DTREFERENCIA' style='display: none;'></span>
                            </div>


                            <div class='input-field col-md-2'>
                                <label for='REC_DTVENCIMENTO' id='tooltip-hover1' class='btn btn-danger' title='O dia escolhido será considerado para os outros meses em caso de geração de boletos para o restante do ano. '>
                                    <i class=' mdi mdi-alert-circle text-danger'></i> VENCIMENTO</label>
                                {!! Form::date('REC_DTVENCIMENTO', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                                <span class='color-danger' id='label-error-REC_DTVENCIMENTO' style='display: none;'></span>
                            </div>

                            <div class='input-field col-md-2'>
                                <label for='restante-ano'>RESTANTE DO ANO</label>
                                <br/>    
                                <div class='radio radio-info radio-inline'>
                                    {!! Form::radio('restante-ano', 'SIM', null, ['id'=>'restante-ano']) !!}
                                    <label for='restante-ano'> Sim</label>
                                    <br/>
                                    {!! Form::radio('restante-ano', 'NAO', true, ['id'=>'restante-ano']) !!}
                                    <label for='restante-ano'> Não</label>
                                </div>
                            </div>
                        </div>




                        <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
                        <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>

                    </form>

                </div>



                <div class='tab-pane' id='unico'>

                    <form method='POST' action="{{url('/restrito/receitas/gerar-boletos-unico')}}" id='form' role='form' 
                          class='form-horizontal' form-send="{{url('/restrito/receitas/gerar-boletos-unico')}}">
                        {{csrf_field()}}

                        



                        <div class='row manager'>
                            <span class='color-danger' id='label-error-REC_NOSSONUMERO' style='display: none;'></span>
                            
                            <div class='input-field col-md-2'>
                                <label for='TR_CODIGO'>DESCRIÇÃO</label>
                                <select name='TR_CODIGO' id='TR_CODIGO' class='select2 form-control' required >
                                    <option></option>
                                    @forelse($tipos as $tipo)
                                    <option value='{{$tipo->TR_CODIGO}}'>{{$tipo->TR_DESCRICAO}}</option>
                                    @empty
                                    <option value=''></option>
                                    @endforelse
                                </select>
                                <span class='color-danger' id='label-error-TR_CODIGO' style='display: none;'></span>
                            </div>
                            
                            <div class='input-field col-md-4'>
                                <label for='user_id'>NOME DO USUÁRIO</label>
                                <select name='user_id' id='user_id' class='select2 form-control' required >
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
                                <label for='REC_DTREFERENCIA'>MÊS DE REFERÊNCIA</label>
                                {!! Form::date('REC_DTREFERENCIA', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                                <span class='color-danger' id='label-error-REC_DTREFERENCIA' style='display: none;'></span>
                            </div>


                            <div class='input-field col-md-2'>
                                <label for='REC_DTVENCIMENTO'>VENCIMENTO</label>
                                {!! Form::date('REC_DTVENCIMENTO', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                                <span class='color-danger' id='label-error-REC_DTVENCIMENTO' style='display: none;'></span>
                            </div>

                            <div class='input-field col-md-2'>
                                <label for='REC_VALOR'>VALOR R$</label>
                                {!! Form::text('REC_VALOR', null, ['class' => 'form-control autonumber', 'required' => 'yes']) !!}
                                <span class='color-danger' id='label-error-REC_VALOR' style='display: none;'></span>
                            </div>


                        </div>




                        <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
                        <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>

                    </form>

                </div>

            </div>



        </div>
    </div>

    @endsection