





<div id="modalFormEndereco" aria-labelledby='' aria-hidden='true' class="modal modalModal Header-fixed-footer">
     
    <div class='card-content'>
        <form method='POST' action='SALVAR-ENDERECO' id='formEndereco' class='col-md-12' form-send='SALVAR-ENDERECO'>
            {{csrf_field()}}
            {!! Form::hidden('IGR_CODIGO', null, ['class' => '', 'required' => 'yes' ]) !!}
            
            
            <div class='modal-content'>
                <h3>ENDERECO | <span class='small-text text-lighten-1'>Gerenciamento de Registros</span></h3>
                <hr/>
                <div class='row'>
                    <div class='input-field col-md-2'>
                        {!! Form::text('END_CEP', null, ['min' => '9', 'maxlength' => '9', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>CEP</label>
                        <span class='color-danger' id='label-error-END_CEP' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-5'>
                        {!! Form::text('END_LOGRADOURO', null, ['min' => '0', 'maxlength' => '100', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>ENDEREÇO</label>
                        <span class='color-danger' id='label-error-END_CEP' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {{ Form::select('END_TIPOLOGRADOURO', [
                                'CASA' => 'CASA', 
                                'APARTAMENTO' => 'APARTAMENTO', 
                                'SALA' => 'SALA', 
                                'LOTE' => 'LOTE'
                    ], null, ['placeholder' => 'TIPO'])
                        }}
                        <span class='color-danger' id='label-error-END_TIPOLOGRADOURO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        {!! Form::text('END_NUMERO', null, ['min' => '', 'maxlength' => '7', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>Nº</label>
                        <span class='color-danger' id='label-error-END_NUMERO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::text('END_COMPLEMENTO', null, ['min' => '', 'maxlength' => '20', 'class' => '', 'style' => 'text-transform: uppercase']) !!}
                        <label>COMPLEMENTO</label>
                        <span class='color-danger' id='label-error-END_CIDADE' style='display: none;'></span>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='input-field col-md-4'>
                        {!! Form::text('END_BAIRRO', null, ['maxlength' => '50', 'class' => '', 'style' => 'text-transform: uppercase']) !!}
                        <label>BAIRRO</label>
                        <span class='color-danger' id='label-error-END_BAIRRO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        {!! Form::text('END_CIDADE', null, ['min' => '4', 'maxlength' => '100', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>CIDADE</label>
                        <span class='color-danger' id='label-error-END_CIDADE' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        {!! Form::text('END_UF', null, ['min' => '2', 'maxlength' => '2', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>UF</label>
                        <span class='color-danger' id='label-error-END_CIDADE' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-3'>
                        {!! Form::text('END_DESCRICAOERRO', null, ['maxlength' => '200', 'class' => '', 'style' => 'text-transform: uppercase',]) !!}
                        <label class='tooltipped red-text' data-position='left' data-delay='50' data-tooltip='Preencha o campo abaixo apenas em caso de correspondências estornadas.'>
                            <i class="material-icons" style="size: 10pt; line-height: 0pt; ">info</i>
                            MOTIVO DEVOLUÇÃO
                        </label>
                        <span class='color-danger' id='label-error-END_DESCRICAOERRO' style='display: none;'></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type='submit' class='waves-effect waves-grey btn green'><i class='fa fa-ok'></i> Salvar Dados</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn white">Fechar</a>
                    <button type='reset' class='waves-effect waves-grey btn yellow darken-1'>Limpar Campos</button>
                </div>
            </div>
        </form>
    </div>
  
</div>




<div id="modalFormDE" aria-labelledby='' aria-hidden='true' class="modal modalModal Header-fixed-footer">
     
    <div class='card-content'>
        <form method='POST' action='SALVAR-DADOS' id='formDE' class='col-md-12' form-send='SALVAR-DADOS'>
            {{csrf_field()}}
            
            {!! Form::hidden('user_id', null, ['class' => '', 'required' => 'yes' ]) !!}
            

            <div class='modal-content'>
                <h3>DADOS ECLESIÁTICOS | <span class='small-text text-lighten-1'>Gerenciamento de Registros</span></h3>
                <hr/>
                <div class='row'>
                    <div class='input-field col-md-2'>
                        {{ Form::select('DEM_ATIVIDADE', [
                                'PASTOR' => 'PASTOR', 
                                'EVANGELISTA' => 'EVANGELISTA', 
                    ], null, ['placeholder' => 'ATIVIDADE', 'class' => '', 'style' => 'text-transform: uppercase', 'required'])
                        }}
                        <span class='color-danger' id='label-error-DEM_ATIVIDADE' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {{ Form::select('DEM_SITUACAO', [
                                'ATIVO' => 'ATIVO', 
                                'JUBILADO' => 'JUBILADO', 
                                'INATIVO' => 'INATIVO', 
                                'ARQUIVO MORTO' => 'ARQUIVO MORTO', 
                    ], null, ['placeholder' => 'SITUAÇÃO', 'class' => '', 'style' => 'text-transform: uppercase', 'required'])
                        }}
                        <span class='color-danger' id='label-error-DEM_SITUACAO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        {{ Form::select('DEM_PRESIDENTEDECAMPO', [
                                'SIM' => 'SIM', 
                                'NÃO' => 'NÃO', 
                    ], null, ['placeholder' => 'P-CAMPO', 'class' => '', 'style' => 'text-transform: uppercase', 'required'])
                        }}
                        <span class='color-danger' id='label-error-DEM_PRESIDENTEDECAMPO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        {{ Form::select('DEM_SUPERVISORCAMPO', [
                                'SIM' => 'SIM', 
                                'NÃO' => 'NÃO', 
                    ], null, ['placeholder' => 'S-CAMPO', 'class' => '', 'style' => 'text-transform: uppercase', 'required'])
                        }}
                        <span class='color-danger' id='label-error-DEM_PRESIDENTEDECAMPO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-1'>
                        {{ Form::select('DEM_ITINERANTE', [
                                'SIM' => 'SIM', 
                                'NÃO' => 'NÃO', 
                    ], null, ['placeholder' => 'ITINERANTE?', 'class' => '', 'style' => 'text-transform: uppercase', 'required'])
                        }}
                        <span class='color-danger' id='label-error-DEM_ITINERANTE' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {{ Form::select('DEM_CURSOTEOLOGICO', [
                                'BÁSICO' => 'BÁSICO', 
                                'MÉDIO' => 'MÉDIO', 
                                'SUPERIOR' => 'SUPERIOR', 
                    ], null, ['placeholder' => 'CURSO TEOLOGICO', 'class' => '', 'style' => 'text-transform: uppercase', 'required' ])
                        }}
                        <span class='color-danger' id='label-error-DEM_CURSOTEOLOGICO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-3'>
                        {{ Form::select('DEM_MESADIRETORA', [
                                'PRESIDENTE' => 'PRESIDENTE', 
                                '1º VICE-PRESIDENTE' => '1º VICE-PRESIDENTE', 
                                '2º VICE-PRESIDENTE' => '2º VICE-PRESIDENTE', 
                                '3º VICE-PRESIDENTE' => '3º VICE-PRESIDENTE', 
                                '4º VICE-PRESIDENTE' => '4º VICE-PRESIDENTE', 
                                '1º SECRETÁRIO' => '1º SECRETÁRIO', 
                                '2º SECRETÁRIO' => '2º SECRETÁRIO', 
                                '3º SECRETÁRIO' => '3º SECRETÁRIO', 
                                '4º SECRETÁRIO' => '4º SECRETÁRIO', 
                                'SECRETÁRIO ADJUNTO' => 'SECRETÁRIO ADJUNTO', 
                                'SECRETÁRIO DE EXPEDIENTE' => 'SECRETÁRIO DE EXPEDIENTE', 
                                '1º TESOUREIRO' => '1º TESOUREIRO', 
                                '2º TESOUREIRO' => '2º TESOUREIRO', 
                    ], null, ['placeholder' => 'MESA DIRETORA'])
                        }}
                        <span class='color-danger' id='label-error-DEM_MESADIRETORA' style='display: none;'></span>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col-md-4'>
                        {{ Form::select('DEM_NOMECONSELHO', [
                                'CONSELHO DE CAPELANIA' => 'CONSELHO DE CAPELANIA', 
                                'CONSELHO POLÍTICO' => 'CONSELHO POLÍTICO', 
                                'CONSELHO DE EXAME DE CONTAS' => 'CONSELHO DE EXAME DE CONTAS', 
                                'CONSELHO DE EDUCAÇÃO E CULTURA' => 'CONSELHO DE EDUCAÇÃO E CULTURA', 
                                'CONSELHO DE ÉTICA E DISCIPLINA' => 'CONSELHO DE ÉTICA E DISCIPLINA', 
                                'CONSELHO ECLESIÁSTICO' => 'CONSELHO ECLESIÁSTICO', 
                                'COMISSÃO CONSULTIVA' => 'COMISSÃO CONSULTIVA', 
                                'COMISSÃO JURÍDICA' => 'COMISSÃO JURÍDICA', 
                                'AGÊNCIA DE MISSÕES' => 'AGÊNCIA DE MISSÕES', 
                                'UEMADS' => 'UEMADS', 
                                'UNIFILHOS' => 'UNIFILHOS', 
                                'UNIKIDS' => 'UNIKIDS', 
                                'UMADSETA' => 'UMADSETA', 
                                'AGEMADSETA' => 'AGEMADSETA', 
                    ], null, ['placeholder' => 'CONSELHO'])
                        }}
                        <span class='color-danger' id='label-error-DEM_NOMECONSELHO' style='display: none;'></span>
                    </div>
                    
                    <div class='input-field col-md-2'>
                        {{ Form::select('DEM_FUNCAOCONSELHO', [
                                'PRESIDENTE' => 'PRESIDENTE', 
                                'SECRETÁRIO' => 'SECRETÁRIO', 
                                'RELATOR' => 'RELATOR', 
                                'MEMBRO' => 'MEMBRO', 
                    ], null, ['placeholder' => 'FUNÇÃO'])
                        }}
                        <span class='color-danger' id='label-error-DEM_FUNCAOCONSELHO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTFILIACAO', \Carbon\Carbon::now()) !!}
                        <label>DT FILIAÇÃO</label>
                        <span class='color-danger' id='label-error-DEM_DTFILIACAO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        {!! Form::text('DEM_APRESENTADOPOR', null, ['maxlength' => '120', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>APRESENTADO POR</label>
                        <span class='color-danger' id='label-error-DEM_APRESENTADOPOR' style='display: none;'></span>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTRECEBIDO', \Carbon\Carbon::now()) !!}
                        <label>DT. RECEBIDO</label>
                        <span class='color-danger' id='label-error-DEM_DTRECEBIDO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-3'>
                        {!! Form::text('DEM_IGREJADEORIGEM', null, ['maxlength' => '80', 'class' => '', 'style' => 'text-transform: uppercase' ]) !!}
                        <label>IGREJA ORIGEM</label>
                        <span class='color-danger' id='label-error-DEM_IGREJADEORIGEM' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-3'>
                        {!! Form::text('DEM_CONVENCAODEORIGEM', null, ['maxlength' => '80', 'class' => '', 'style' => 'text-transform: uppercase' ]) !!}
                        <label>CONVENÇÃO ORIGEM</label>
                        <span class='color-danger' id='label-error-DEM_CONVENCAODEORIGEM' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                       {{ Form::select('DEM_DTREINTEGRADO', [
                                'SIM' => 'SIM', 
                                'NÃO' => 'NÃO', 
                            ], null, ['placeholder' => 'REINTEGRADO'])
                        }}
                        <span class='color-danger' id='label-error-DEM_DTREINTEGRADO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTMUDANCA', \Carbon\Carbon::now()) !!}
                        <label>DT. MUDANÇA</label>
                        <span class='color-danger' id='label-error-DEM_DTMUDANCA' style='display: none;'></span>
                    </div>
                </div>
                
                <div class='row'>    
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTMUDANCADEAREA', \Carbon\Carbon::now()) !!}
                        <label>DT. MUD. ÁREA</label>
                        <span class='color-danger' id='label-error-DEM_DTMUDANCADEAREA' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTDESLIGAMENTO', \Carbon\Carbon::now()) !!}
                        <label>DT. DESLIGAMENTO</label>
                        <span class='color-danger' id='label-error-DEM_DTDESLIGAMENTO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {{ Form::select('DEM_MOTIVODESLIGAMENTO', [
                                'MUDANÇA' => 'MUDANÇA', 
                                'FALECIMENTO' => 'FALECIMENTO', 
                                'DESCREDENCIAMENTO' => 'DESCREDENCIAMENTO', 
                    ], null, ['placeholder' => 'MOTIVO'])
                        }}
                        <span class='color-danger' id='label-error-DEM_MOTIVODESLIGAMENTO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTBATISMOAGUA', \Carbon\Carbon::now()) !!}
                        <label>DT. BATISMO</label>
                        <span class='color-danger' id='label-error-DEM_DTBATISMOAGUA' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTBATISMOESPIRITO', \Carbon\Carbon::now()) !!}
                        <label>BATISMO E. S.</label>
                        <span class='color-danger' id='label-error-DEM_DTBATISMOESPIRITO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTCONSAGRACAO', \Carbon\Carbon::now()) !!}
                        <label>DT. CONSAGRAÇÃO</label>
                        <span class='color-danger' id='label-error-DEM_DTCONSAGRACAO' style='display: none;'></span>
                    </div>
                </div>
                
                <div class='row'>    
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTORDENACAO', \Carbon\Carbon::now()) !!}
                        <label>DT. ORDENAÇÃO</label>
                        <span class='color-danger' id='label-error-DEM_DTORDENACAO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::date('DEM_DTJUBILADO', \Carbon\Carbon::now()) !!}
                        <label>DT. JUBILADO</label>
                        <span class='color-danger' id='label-error-DEM_DTJUBILADO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::text('DEM_CARGOTIPO', null, ['maxlength' => '120', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>TIPO CARGO</label>
                        <span class='color-danger' id='label-error-DEM_CARGOTIPO' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-2'>
                        {!! Form::text('DEM_CARGOHIERARQUIA', null, ['min' => '2', 'maxlength' => '30', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>HIERÁRQUIA</label>
                        <span class='color-danger' id='label-error-DEM_CARGOHIERARQUIA' style='display: none;'></span>
                    </div>
                    
                    <div class='input-field col-md-2'>
                        {!! Form::text('DEM_OBSERVACAO', null, ['maxlength' => '500', 'class' => '', 'style' => 'text-transform: uppercase' ]) !!}
                        <label>OBSERVAÇÃO</label>
                        <span class='color-danger' id='label-error-DEM_OBSERVACAO' style='display: none;'></span>
                    </div>
                </div>

                    


                </div>

                <div class="modal-footer">
                    <button type='submit' class='waves-effect waves-grey btn green'><i class='fa fa-ok'></i> Salvar Dados</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn white">Fechar</a>
                    <button type='reset' class='waves-effect waves-grey btn yellow darken-1'>Limpar Campos</button>
                </div>
            </div>
        </form>
    </div>
  
</div>












<div id="modalFormDependente" aria-labelledby='' aria-hidden='true' class="modal modalModal Header-fixed-footer">
     
    <div class='card-content'>
        <form method='POST' action='SALVAR-DEPENDENTE' id='formDependente' class='col-md-12' form-send='SALVAR-DEPENDENTE'>
            {{csrf_field()}}
            {!! Form::hidden('user_id', null, ['class' => '', 'required' => 'yes' ]) !!}
            

            <div class='modal-content'>
                <h3>DEPENDENTES | <span class='small-text text-lighten-1'>Gerenciamento de Registros</span></h3>
                <hr/>
                <div class='row'>
                    <div class='input-field col-md-5'>
                        {!! Form::text('DEP_NOME', null, ['min' => '10', 'maxlength' => '120', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>NOME</label>
                        <span class='color-danger' id='label-error-DEP_NOME' style='display: none;'></span>
                    </div>
                    <div class='input-field col-md-4'>
                        {{ Form::select('DEP_GRAUPARENTESCO', [
                                'PAI' => 'PAI', 
                                'MÃE' => 'MÃE', 
                                'FILHO(A)' => 'FILHO(A)', 
                                'ENTEADO(A)' => 'ENTEADO(A)', 
                                'IRMÃO(Ã)' => 'IRMÃO(Ã)', 
                                'TIO(A)' => 'TIO(A)', 
                                'AVÔ(Ó)' => 'AVÔ(Ó)', 
                                'OUTRO' => 'OUTRO', 
                    ], null, ['placeholder' => 'GRAU DE PARENTESCO'])
                        }}
                        <span class='color-danger' id='label-error-BAN_TIPOCONTA' style='display: none;'></span>
                    </div>
                    
                    <div class='input-field col-md-3'>
                        {!! Form::date('DEP_DATANASCIMENTO', \Carbon\Carbon::now()) !!}
                        <label>DT. NASCIMENTO</label>
                        <span class='color-danger' id='label-error-DEP_DATANASCIMENTO' style='display: none;'></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type='submit' class='waves-effect waves-grey btn green'><i class='fa fa-ok'></i> Salvar Dados</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn white">Fechar</a>
                    <button type='reset' class='waves-effect waves-grey btn yellow darken-1'>Limpar Campos</button>
                </div>
            </div>
        </form>
    </div>
  
</div>


























<div id="modalFormBank" aria-labelledby='' aria-hidden='true' class="modal modalModal Header-fixed-footer">
     
    <div class='card-content'>
        <form method='POST' action='SALVAR-BANK' id='formBank' class='col-md-12' form-send='SALVAR-BANK'>
            {{csrf_field()}}
            

            <div class='modal-content'>
                <h3>DADOS BANCÁRIOS | <span class='small-text text-lighten-1'>Gerenciamento de Registros</span></h3>
                <hr/>
            {!! Form::hidden('user_id', null, ['class' => '', 'required' => 'yes' ]) !!}
                <div class='row'>
                    <div class='input-field col-md-3'>
                        {!! Form::text('BAN_NOME', null, ['min' => '4', 'maxlength' => '50', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>NOME DO BANCO</label>
                        <span class='color-danger' id='label-error-BAN_NOME' style='display: none;'></span>
                    </div>
                    
                    <div class='input-field col-md-2'>
                        {!! Form::text('BAN_AGENCIA', null, ['maxlength' => '7', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>AGÊNCIA</label>
                        <span class='color-danger' id='label-error-BAN_AGENCIA' style='display: none;'></span>
                    </div>
                    
                    <div class='input-field col-md-3'>
                        {{ Form::select('BAN_TIPOCONTA', [
                                'CORRENTE' => 'CORRENTE', 
                                'POUPANÇA' => 'POUPANÇA', 
                    ], null, ['placeholder' => 'TIPO DE CONTA'])
                        }}
                        <span class='color-danger' id='label-error-BAN_TIPOCONTA' style='display: none;'></span>
                    </div>
                    
                    <div class='input-field col-md-2'>
                        {!! Form::text('BAN_CONTA', null, ['maxlength' => '20', 'class' => '', 'style' => 'text-transform: uppercase', 'required' => 'yes']) !!}
                        <label>CONTA</label>
                        <span class='color-danger' id='label-error-BAN_CONTA' style='display: none;'></span>
                    </div>

                    
                    <div class='input-field col-md-2'>
                        {!! Form::text('BAN_VARIACAO', null, ['maxlength' => '5', 'class' => '', 'style' => 'text-transform: uppercase']) !!}
                        <label>VARIAÇÃO</label>
                        <span class='color-danger' id='label-error-BAN_VARIACAO' style='display: none;'></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type='submit' class='waves-effect waves-grey btn green'><i class='fa fa-ok'></i> Salvar Dados</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn white">Fechar</a>
                    <button type='reset' class='waves-effect waves-grey btn yellow darken-1'>Limpar Campos</button>
                </div>
            </div>
        </form>
    </div>
  
</div>









































<div id="modalFormFicha" aria-labelledby='' aria-hidden='true' class="modal modalModal Header-fixed-footer">

    <div class="modal-content">
        <div class='row divisory'>
            <h3>DADOS PESSOAIS</h3>
            <div class='input-field col-md-2'>
                <span id='SPAN_matricula'></span>
                <label class='active'>Matricula</label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_name'></span>
                <label class='active'>Nome</label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_IGR_NOMECONGRECACAO'></span>
                <label class='active'>Congregação</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_dtnascimento'></span>
                <label class='active'>Dt. Nasc</label>
            </div>
        </div>
        
        <div class='row divisory'>
            <div class='input-field col-md-2'>
                <span id='SPAN_cpf'></span>
                <label class='active'>CPF</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_rg'></span>
                <label class='active'>RG</label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_pai'></span>
                <label class='active'>Pai</label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_mae'></span>
                <label class='active'>Mãe</label>
            </div>
        </div>
        
        
        
        <div class='row'>
            <div class='input-field col-md-3'>
                <span id='SPAN_nacionalidade'></span>
                <label class='active'>Nacionalidade</label>
            </div>
            <div class='input-field col-md-3'>
                <span id='SPAN_escolaridade'></span>
                <label class='active'>Escolaridade</label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_estadocivil'></span>
                <label class='active'>Estado Civil</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_dtcasamento'></span>
                <label class='active'>Dt. Casamento</label>
            </div>
        </div>
        
        <div class='row divisory'>
            <div class='input-field col-md-3'>
                <span id='SPAN_naturalidade'></span>
                <label class='active'>Naturalidade</label>
            </div>
            <div class='input-field col-md-3'>
                <span id='SPAN_'></span>
                <label class='active'> </label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_conjuge'></span>
                <label class='active'>Cônjuge</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_dtviuvez'></span>
                <label class='active'>Dt. Viuvez</label>
            </div>
        </div>
        
        <div class='row divisory'>
            <h3>CONTATOS</h3>
            <div class='input-field col-md-3'>
                <span id='SPAN_phone'></span>
                <label class='active'>Fone</label>
            </div>
            <div class='input-field col-md-3'>
                <span id='SPAN_cellphone'></span>
                <label class='active'>Celular</label>
            </div>
            <div class='input-field col-md-6'>
                <span id='SPAN_email'></span>
                <label class='active'>Email</label>
            </div>
        </div>



        <div class='row divisory'>
            <h3>ENDEREÇO</h3>
            <div class='input-field col-md-2'>
                <span id='SPAN_END_CEP'></span>
                <label class='active'>CEP</label>
            </div>
            <div class='input-field col-md-5'>
                <span id='SPAN_END_LOGRADOURO'></span>
                <label class='active'>LOGRADOURO</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_END_TIPOLOGRADOURO'></span>
                <label class='active'>TP LGDR</label>
            </div>
            <div class='input-field col-md-1'>
                <span id='SPAN_END_NUMERO'></span>
                <label class='active'>Nº</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_END_COMPLEMENTO'></span>
                <label class='active'>COMPLEMENTO</label>
            </div>
        </div>
        <div class='row divisory'>
            <div class='input-field col-md-3'>
                <span id='SPAN_END_BAIRRO'></span>
                <label class='active'>BAIRRO</label>
            </div>
            <div class='input-field col-md-4'>
                <span id='SPAN_END_CIDADE'></span>
                <label class='active'>CIDADE</label>
            </div>
            <div class='input-field col-md-1'>
                <span id='SPAN_END_UF'></span>
                <label class='active'>UF</label>
            </div>
            
            
            <div class='input-field col-md-4'>
                <span id='SPAN_END_DESCRICAOERRO'></span>
                <label class='active'>SATATUS ERRO</label>
            </div>
        </div>
        
        
        
        
        <div class='row divisory'>
            <h3>DADOS BANCÁRIOS</h3>
            <div class='input-field col-md-5'>
                <span id='SPAN_BAN_NOME'></span>
                <label class='active'>BANCO</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_BAN_AGENCIA'></span>
                <label class='active'>AGÊNCIA</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_BAN_TIPOCONTA'></span>
                <label class='active'>TIPO DE CONTA</label>
            </div>
            <div class='input-field col-md-2'>
                <span id='SPAN_BAN_CONTA'></span>
                <label class='active'>CONTA</label>
            </div>
            <div class='input-field col-md-1'>
                <span id='SPAN_BAN_VARIACAO'></span>
                <label class='active'>VARIAÇÃO</label>
            </div>
            
        </div>
        
        
        

        <div class="modal-footer">
            <!--<button type='submit' class='waves-effect waves-grey btn green'><i class='fa fa-ok'></i> Salvar Dados</button>-->
            <a href="#" class="modal-action modal-close waves-effect waves-green btn white">Fechar</a>
        </div>
    </div>
</form>
</div>

@push('css')
@endpush

@push('js-topo')
@endpush

@push('js-footer')

@endpush

@endsection