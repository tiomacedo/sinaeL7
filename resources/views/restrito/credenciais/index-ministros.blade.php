@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'><a href='{{url('/restrito/credencial/ministros')}}'>CREDENCIAIS DE MINISTROS</a></li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>CREDENCIAIS | <small>MINISTROS</small></h4>
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
                        <th>NOME</th>
                        <th width='40px'>MATR.</th>
                        <th width='80px'>CPF</th>
                        <th width='100px'>ATIVIDADE</th>
                        <th width='40px'>EM</th>
                        <th width='40px'>VAL</th>
                        <th width='20px'>STATUS</th>
                        <th width='70px'>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>

                        <td style='text-align: center'>
                            @if(isset($registro->foto) && $registro->foto!='' && $registro->foto!=null)
                            <img src='{{url("/assets/users/$registro->foto")}}' 
                                 alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            @else
                            <img src='{{url("/assets/users/not_img.jpg")}}' 
                                 alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            @endif
                        </td>
                        <td>{{$registro->name}}</td>
                        <td>{{$registro->matricula}}</td>
                        <td>{{$registro->cpf}}</td>
                        <td>{{$registro->DEM_ATIVIDADE}}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->CREDEN_DTEMISSAO)->format('d/m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->CREDEN_DTVALIDADE)->format('m/Y')}}</td>
                        <td>{{$registro->CREDEN_STATUS}}</td>
                        <td>
                            @if($registro->CREDEN_STATUS!='INCOMPLETA')
                            <a href='{{url("/restrito/credenciais/carteira/$registro->CREDEN_CODIGO")}}' target='_blank' class='btn btn-xs waves-effect btn-default'>
                                <i class='mdi mdi-account-card-details'></i>
                            </a>
                            @endif
                            <a href='#' class='btn btn-xs waves-effect btn-success'
                               onclick="edit('{{url("/restrito/credenciais/editar/$registro->CREDEN_CODIGO")}}')" id='edit'>
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

<div id='modalForm' class='modal fade' role='dialog' aria-labelledby='full-width-modalLabel' aria-hidden='true' style='display: none;'>
    <div class='modal-dialog modal-full'>
        <div class='modal-content'>
            <form method='POST' action="{{url('/restrito/credenciais/cadastrar')}}" id='form' role='form' 
                  class='form-horizontal' form-send="{{url('/restrito/credenciais/cadastrar')}}">
                {{csrf_field()}}
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                    <h4>CREDENCIAIS | <span class='small-text text-lighten-1'>Formulário de Gerenciamento</span></h4>
                </div>
                <div class='modal-body'>
                    <div class='row manager'>
                        <div class='input-field col-md-4'>
                            <label for='CREDEN_STATUS'>STATUS DA CREDENCIAL</label>
                            <select name='CREDEN_STATUS' id='CREDEN_STATUS' class="form-control">
                                <option></option>
                                <option value='INCOMPLETA'>INCOMPLETA</option>
                                <option value='IMPRESSA'>IMPRESSA</option>
                                <option value='EXTRAVIADA'>EXTRAVIADA</option>
                            </select>
                            <span class='text-danger' id='label-error-CREDEN_STATUS' style='display: none;'></span>
                        </div>
                        <div class='input-field col-md-2'>
                            <label for='CREDEN_DTEMISSAO'>DATA EMISSÃO</label>
                            {!! Form::date('CREDEN_DTEMISSAO', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'yes']) !!}
                            <span class='text-danger' id='label-error-CREDEN_DTEMISSAO' style='display: none;'></span>
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