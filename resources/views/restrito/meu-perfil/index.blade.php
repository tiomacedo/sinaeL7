@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/meu-perfil')}}'>MEU PERFIL</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>MEU PERFIL | <small>{{Auth::user()->name}}</small></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="text-center card-box">
                        @forelse($data as $dado)
                        <div class="member-card">
                            <div class="thumb-xl member-thumb m-b-10 center-block">
                                @if (Auth::user()->foto)
                                <img src="{{url('/')}}/assets/users/{{Auth::user()->foto}}" class="media-object m-r-10" style="width: 96px; height: 125px;" /> 
                                @else
                                <img src="{{url('/assets/users/not_img.jpg')}}" class="media-object m-r-10" style="width: 96px; height: 125px;" /> 
                                @endif
                                <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                            </div>
                            <div class="">
                                <h4 class="m-b-5">{{$dado->name}}</h4>
                                <p class="text-muted">{{$dado->DEM_ATIVIDADE}}</p>

                            </div>
                            <hr/>
                            <div class="text-left">
                                <p class="text-muted font-13">
                                    <strong>Dt. Nascimento:</strong> <br/>
                                    {{ \Carbon\Carbon::parse($dado->dtnascimento)->format('d/m/Y')}}
                                </p>
                                <p class="text-muted font-13">
                                    <strong>CPF:</strong> <br/>
                                    {{$dado->cpf}}
                                </p>
                                <p class="text-muted font-13">
                                    <strong>Fone:</strong> <br/>
                                    {{$dado->phone}}
                                </p>
                                <p class="text-muted font-13">
                                    <strong>Celular:</strong> <br/>
                                    {{$dado->cellphone}}
                                </p>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div> <!-- end card-box -->
                </div> <!-- end col -->

                <div class="col-lg-9 col-md-9">
                    @forelse($data as $dado)
                    <div class="row">
                        <div class='modal-body'>
                            <div class='row manager divisory'>
                                <h3>DADOS PESSOAIS</h3>
                                <div class='input-field col-md-2'>
                                    <label for=''>MATRÍCULA</label>
                                    <br/>
                                    <span id='SPAN_matricula' class='text-uppercase'>{{$dado->matricula}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>NOME</label>
                                    <br/>
                                    <span id='SPAN_name' class='text-uppercase'>{{$dado->name}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>IGREJA QUE FREQUENTA</label>
                                    <br/>
                                    <span id='SPAN_IGR_NOMECONGRECACAO' class='text-uppercase'>
                                        {{ $igrejas->IGR_MATRICULA }} - {{ $igrejas->IGR_NOMECONGRECACAO }} 
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DATA NASC.</label>
                                    <br/>
                                    <span id='SPAN_dtnascimento' class='text-uppercase'>{{ \Carbon\Carbon::parse($dado->dtnascimento)->format('d/m/Y')}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>CPF</label>
                                    <br/>
                                    <span id='SPAN_cpf' class='text-uppercase'>{{$dado->cpf}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>RG</label>
                                    <br/>
                                    <span id='SPAN_rg' class='text-uppercase'>{{$dado->rg}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>TÍTULO</label>
                                    <br/>
                                    <span id='SPAN_rg' class='text-uppercase'>{{$dado->titulo_eleitoral}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>PROFISSÃO</label>
                                    <br/>
                                    <span id='SPAN_rg' class='text-uppercase'>{{$dado->profissao}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>NACIONALIDADE</label>
                                    <br/>
                                    <span id='SPAN_rg' class='text-uppercase'>{{$dado->nacionalidade}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-3'>
                                    <label for=''>NATURALIDADE</label>
                                    <br/>
                                    <span id='SPAN_rg' class='text-uppercase'>{{$dado->CID_NOME}}/{{$dado->CID_UF}}</span>
                                </div>
                                <div class='input-field col-md-5'>
                                    <label for=''>NOME DA MÃE</label>
                                    <br/>
                                    <span id='SPAN_mae' class='text-uppercase'>{{$dado->mae}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>NOME DO PAI</label>
                                    <br/>
                                    <span id='SPAN_pai' class='text-uppercase'>{{$dado->pai}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>ESCOLARIDADE</label>
                                    <br/>
                                    <span id='SPAN_escolaridade' class='text-uppercase'>{{$dado->escolaridade}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>ESTADO CIVIL</label>
                                    <br/>
                                    <span id='SPAN_estadocivil' class='text-uppercase'>{{$dado->estadocivil}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>CÔNJUGE</label>
                                    <br/>
                                    <span id='SPAN_conjuge' class='text-uppercase'>{{$dado->conjuge}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DATA CASAMENTO</label>
                                    <br/>
                                    <span id='SPAN_dtcasamento' class='text-uppercase'>
                                        @if(isset($dado->dtcasamento))
                                            {{ \Carbon\Carbon::parse($dado->dtcasamento)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DATA VIUVEZ</label>
                                    <br/>
                                    <span id='SPAN_dtviuvez' class='text-uppercase'>
                                        @if(isset($dado->dtviuvez))
                                            {{ \Carbon\Carbon::parse($dado->dtviuvez)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <h3>CONTATOS</h3>
                                <div class='input-field col-md-3'>
                                    <label for=''>FONE</label>
                                    <br/>
                                    <span id='SPAN_phone' class='text-uppercase'>{{$dado->phone}}</span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>CELULAR</label>
                                    <br/>
                                    <span id='SPAN_cellphone' class='text-uppercase'>{{$dado->cellphone}}</span>
                                </div>
                                <div class='input-field col s6'>
                                    <label for=''>EMAIL</label>
                                    <br/>
                                    <span id='SPAN_email' class='text-lowercase'>{{$dado->email}}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>


                    <h3>ENDEREÇO</h3>
                    @forelse($enderecos as $endereco)
                    <div class="row">
                        <div class='modal-body'>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>CEP</label>
                                    <br/>
                                    <span id='SPAN_END_CEP'>{{$endereco->END_CEP}}</span>
                                </div>
                                <div class='input-field col-md-5'>
                                    <label for=''>LOGRADOURO</label>
                                    <br/>
                                    <span id='SPAN_END_LOGRADOURO' class='text-uppercase'>{{$endereco->END_LOGRADOURO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>TP LGDR</label>
                                    <br/>
                                    <span id='SPAN_END_TIPOLOGRADOURO' class='text-uppercase'>{{$endereco->END_TIPOLOGRADOURO}}</span>
                                </div>
                                <div class='input-field col-md-1'>
                                    <label for=''>Nº</label>
                                    <br/>
                                    <span id='SPAN_END_NUMERO' class='text-uppercase'>{{$endereco->END_NUMERO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>COMPLEMENTO</label>
                                    <br/>
                                    <span id='SPAN_END_COMPLEMENTO' class='text-uppercase'>{{$endereco->END_COMPLEMENTO}}</span>
                                </div>
                            </div>

                            <div class='row manager divisory'>
                                <div class='input-field col-md-3'>
                                    <label for=''>BAIRRO</label>
                                    <br/>
                                    <span id='SPAN_END_BAIRRO' class='text-uppercase'>{{$endereco->END_BAIRRO}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>CIDADE</label>
                                    <br/>
                                    <span id='SPAN_END_CIDADE' class='text-uppercase'>
                                        {{$endereco->CID_NOME}}
                                    </span>
                                </div>
                                <div class='input-field col-md-1'>
                                    <label for=''>UF</label>
                                    <br/>
                                    <span id='SPAN_END_UF' class='text-uppercase'>{{$endereco->CID_UF}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>ERRO NA ENTREGA?</label>
                                    <br/>
                                    <span id='SPAN_END_DESCRICAOERRO' class='text-uppercase'>{{$endereco->END_DESCRICAOERRO}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class='row manager divisory'>
                        <div class='input-field'>
                            <p>NENHUM DADO INSERIDO ATÉ O MOMENTO</p>
                        </div>
                    </div>
                    @endforelse



                    <h3>DEPENDENTES</h3>
                    <div class="row">
                        <div class='modal-body'>
                            @forelse($dependentes as $dependente)
                            <div class='row manager divisory'>
                                <div class='input-field col-md-7'>
                                    <label for=''>NOME</label>
                                    <br/>
                                    <span id='SPAN_END_CEP'>{{$dependente->DEP_NOME}}</span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>PARENTESCO</label>
                                    <br/>
                                    <span id='SPAN_END_CEP'>{{$dependente->DEP_GRAUPARENTESCO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. NASCIMENTO</label>
                                    <br/>
                                    <span id='SPAN_END_CEP'>
                                        {{ \Carbon\Carbon::parse($dependente->DEP_DATANASCIMENTO)->format('d/m/Y')}}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class='row manager divisory'>
                                <div class='input-field'>
                                    <p>NENHUM DADO INSERIDO ATÉ O MOMENTO</p>
                                </div>

                            </div>
                            @endforelse
                        </div>
                    </div>


                    <h3>DADOS ECLESIÁSTICOS</h3>
                    <div class="row">
                        @if($dado->tp == 'MIN')
                        @forelse($dems as $dem)
                        <div class='modal-body'>

                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>ATIVIDADE</label> <br/>
                                    <span>{{$dem->DEM_ATIVIDADE}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>SITUAÇÃO</label> <br/>
                                    <span>{{$dem->DEM_SITUACAO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>PRES. CAMPO</label> <br/>
                                    <span>{{$dem->DEM_PRESIDENTEDECAMPO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>SUP. ÁREA</label> <br/>
                                    <span>{{$dem->DEM_SUPERVISORCAMPO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>ITINERANTE</label> <br/>
                                    <span>{{$dem->DEM_ITINERANTE}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>CURSO TEOLÓGICO</label> <br/>
                                    <span>{{$dem->DEM_CURSOTEOLOGICO}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>CARGO M. DIRETORA</label> <br/>
                                    <span>{{$dem->DEM_MESADIRETORA}}</span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>PARTICIPA DO CONSELHO</label> <br/>
                                    <span>{{$dem->DEM_NOMECONSELHO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>FUNÇÃO</label> <br/>
                                    <span>{{$dem->DEM_FUNCAOCONSELHO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>FILIAÇÃO</label> <br/>
                                    <span>
                                        @if(isset($dem->DEM_DTFILIACAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTFILIACAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>APRESENTADO POR</label> <br/>
                                    <span>{{$dem->DEM_APRESENTADOPOR}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>RECEBIDO EM</label> <br/>
                                    <span>
                                        @if(isset($dem->DEM_DTRECEBIDO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTRECEBIDO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>IGREJA DE ORIGEM</label> <br/>
                                    <span>{{$dem->DEM_IGREJADEORIGEM}}</span>
                                </div>
                                <div class='input-field col-md-1'>
                                    <label for=''>NATIVO?</label> <br/>
                                    <span>{{$dem->DEM_NATIVO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>CONV. DE ORIGEM</label> <br/>
                                    <span>{{$dem->DEM_CONVENCAODEORIGEM}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. MUDANÇA</label> <br/>
                                    <span>
                                        @if(isset($dem->DEM_DTMUDANCA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTMUDANCA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-1'>
                                    <label for=''>REINTEGRADO?</label> <br/>
                                    <span>{{$dem->DEM_REINTEGRADO}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>CARTA MUDANÇA</label> <br/>
                                    <span>
                                        @if(isset($dem->DEM_DTCARTAMUDANCA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTCARTAMUDANCA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT MUD. ÁREA</label> <br/>
                                    <span>@if(isset($dem->DEM_DTMUDANCADEAREA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTMUDANCADEAREA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. CONVERSÃO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTCONVERSAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTCONVERSAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>CONGREGADO DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTCONGREGADODESDE))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTCONGREGADODESDE)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>AUXILIAR DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTAUXILIAR))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTAUXILIAR)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DIÁCONO DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTDIACONO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTDIACONO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>PRESBÍTERO DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTPRESBITERO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTPRESBITERO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>EVANGELISTA DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTEVANGELISTA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTEVANGELISTA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DIRIGENTE DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTDIRIGENTE))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTDIRIGENTE)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>PASTOR DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTPASTOR))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTPASTOR)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. ACLAMAÇÃO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTACLAMACAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTACLAMACAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. CONSAGRAÇÃO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTCONSAGRACAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTCONSAGRACAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. ORDENAÇÃO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTORDENACAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTORDENACAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. BATISMO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTBATISMOAGUA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTBATISMOAGUA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. B. ESPÍTIRO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTBATISMOESPIRITO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTBATISMOESPIRITO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. DESLIGAMENTO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTDESLIGAMENTO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTDESLIGAMENTO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>MOTIVO DESLIGAMENTO</label> <br/>
                                    <span>{{$dem->DEM_MOTIVODESLIGAMENTO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. JUBILADO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTJUBILADO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTJUBILADO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-3'>
                                    <label for=''>DEP. IGREJA</label> <br/>
                                    <span>{{$dem->DEM_DEPARTAMENTOIGREJA}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTDEPARTAMENTOIGREJA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTDEPARTAMENTOIGREJA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>FUNÇÃO NO DEPARTAMENTO</label> <br/>
                                    <span>{{$dem->DEM_FUNCAODEPARTAMENTOIGREJA}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>OBSERVAÇÃO</label> <br/>
                                    <span>{{$dem->DEM_OBSERVACAO}}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>NENHUM DADO INSERIDO ATÉ O MOMENTO</p>
                        @endforelse
                        @endif
                        
                        
                        
                        
                        @if($dado->tp == 'MIS')
                        @forelse($dems as $dem)
                        <div class='modal-body'>

                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>ATIVIDADE</label> <br/>
                                    <span>{{$dem->DEM_ATIVIDADE}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>SITUAÇÃO</label> <br/>
                                    <span>{{$dem->DEM_SITUACAO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>CURSO TEOLÓGICO</label> <br/>
                                    <span>{{$dem->DEM_CURSOTEOLOGICO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>CONSELHO</label> <br/>
                                    <span>{{$dem->DEM_NOMECONSELHO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>FUNÇÃO</label> <br/>
                                    <span>{{$dem->DEM_FUNCAOCONSELHO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>FILIAÇÃO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTFILIACAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTFILIACAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>RECEBIDO EM</label> <br/>
                                    <span>@if(isset($dem->DEM_DTRECEBIDO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTRECEBIDO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>IGREJA DE ORIGEM</label> <br/>
                                    <span>{{$dem->DEM_IGREJADEORIGEM}}</span>
                                </div>
                                <div class='input-field col-md-1'>
                                    <label for=''>NATIVO?</label> <br/>
                                    <span>{{$dem->DEM_NATIVO}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>CONV. DE ORIGEM</label> <br/>
                                    <span>{{$dem->DEM_CONVENCAODEORIGEM}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. MUDANÇA</label> <br/>
                                    <span>@if(isset($dem->DEM_DTMUDANCA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTMUDANCA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-1'>
                                    <label for=''>REINTEGRADO?</label> <br/>
                                    <span>{{$dem->DEM_REINTEGRADO}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-2'>
                                    <label for=''>CARTA MUDANÇA</label> <br/>
                                    <span>@if(isset($dem->DEM_DTCARTAMUDANCA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTCARTAMUDANCA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. CONVERSÃO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTCONVERSAO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTCONVERSAO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. BATISMO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTBATISMOAGUA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTBATISMOAGUA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. B. ESPÍTIRO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTBATISMOESPIRITO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTBATISMOESPIRITO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DT. DESLIGAMENTO</label> <br/>
                                    <span>@if(isset($dem->DEM_DTDESLIGAMENTO))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTDESLIGAMENTO)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>MOTIVO DESLIGAMENTO</label> <br/>
                                    <span>{{$dem->DEM_MOTIVODESLIGAMENTO}}</span>
                                </div>
                            </div>
                            <div class='row manager divisory'>
                                <div class='input-field col-md-3'>
                                    <label for=''>DEP. IGREJA</label> <br/>
                                    <span>{{$dem->DEM_DEPARTAMENTOIGREJA}}</span>
                                </div>
                                <div class='input-field col-md-2'>
                                    <label for=''>DESDE</label> <br/>
                                    <span>@if(isset($dem->DEM_DTDEPARTAMENTOIGREJA))
                                            {{ \Carbon\Carbon::parse($dem->DEM_DTDEPARTAMENTOIGREJA)->format('d/m/Y')}}
                                        @endif
                                    </span>
                                </div>
                                <div class='input-field col-md-3'>
                                    <label for=''>FUNÇÃO NO DEPARTAMENTO</label> <br/>
                                    <span>{{$dem->DEM_FUNCAODEPARTAMENTOIGREJA}}</span>
                                </div>
                                <div class='input-field col-md-4'>
                                    <label for=''>OBSERVAÇÃO</label> <br/>
                                    <span>{{$dem->DEM_OBSERVACAO}}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>NENHUM DADO INSERIDO ATÉ O MOMENTO</p>
                        @endforelse
                        @endif
                    </div>
                </div>




            </div>
            <!-- end col -->

        </div>
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