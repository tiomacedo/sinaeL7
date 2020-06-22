<div class='modal-body'>
    <div class='row manager' id='repeat'>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-border">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class='input-field col-md-3'>
                                <label for='REC_DTRECEBIMENTO'>DT. DA TRANSAÇÃO</label>
                                {!! Form::date('REC_DTRECEBIMENTO', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                                @if ($errors->has('REC_DTRECEBIMENTO'))
                                <span class='text-danger'> {{ $errors->first('REC_DTRECEBIMENTO') }} </span>
                                @endif
                            </div>
                            <div class='input-field col-md-5'>
                                <label for='REC_COLETOR'>VALOR ENTREGUE A:</label>
                                <select name='REC_COLETOR' id='REC_COLETOR' class="select2 form-control" required>
                                    <option value="1">DEPÓSITO BANCÁRIO</option>
                                    @forelse($coletores as $coletor)
                                    <option value="{{$coletor->id}}">{{$coletor->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('REC_COLETOR'))
                                <span class='text-danger'> {{ $errors->first('REC_COLETOR') }} </span>
                                @endif
                            </div>
                            <div class='input-field col-md-4'>
                                <label for='foto'>ANEXAR COMPROVANTE (EM CASO DE DEPÓSITOS BANCÁRIOS)</label>
                                {!! Form::file('foto', ['class' => 'form-control']) !!}
                            </div>
                            @if ($errors->has('foto'))
                            <span class='text-danger'> {{ $errors->first('foto') }} </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-t-40">
            <div class="col-md-6">
                <a href="#" id="btnNewItem" class="btn btn-success">NOVO REGISTRO</a>
            </div>
            <div class="col-md-6 text-right">
                <h3>Total: <span id="total"></span></h3>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <td class='input-field col-md-6'> 
                        <label for='TR_CODIGO'>TIPO DA CONTRIBUIÇÃO</label>
                    </td>
                    <td class='input-field col-md-3'>
                        <label for='REC_DTREFERENCIA'>MÊS DE REFERÊNCIA</label>
                    </td>
                    <td class='input-field col-md-3'>
                        <label for='REC_VALOR'>VALOR R$</label>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][TR_CODIGO]" class="form-control">
                            @forelse($tipos as $tipo)
                            <option value="{{$tipo->TR_CODIGO}}">{{$tipo->TR_DESCRICAO}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        {!! Form::date('items[0][REC_DTREFERENCIA]', null, ['class' => 'form-control', 'required' => 'yes']) !!}
                    </td>
                    <td>
                        {!! Form::text('items[0][REC_VALOR]', 1, ['class'=>'form-control autonumber', 'id'=>'REC_VALOR', 'required' => 'yes']) !!}
                    </td>
                </tr>
            </tbody>
        </table>
        <p class='small-text'>
            Caso o valor repassado/depositado seja referente a um montante de mais de uma modalidde de contribuição, ou ainda, referente a mais de um mês, clique em 
            <span class='label label-success'>NOVO REGISTRO</span> para adicionar uma nova linha para que seja descriminado a MODALIDADE DA CONTRIBUIÇÃO, MÊS DE REFERÊNCIA, E O VALOR DE CADA MODALIDADE.
        </p>
    </div>
</div>

<div class='modal-footer'>
    <button type='reset' class='btn btn-default waves-effect'>Resetar</button>
    <button type='submit' class='btn btn-primary waves-effect waves-light'>Salvar Dados</button>
</div>