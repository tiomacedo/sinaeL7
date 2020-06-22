@extends('layouts.restrito')
@section('content')
<div class='row'>
    <div class='col-sm-12'>
        <div class='page-title-box'>
            <div class='btn-group pull-right'>
                <h4>
                    <ol class='breadcrumb hide-phone p-0 m-0'>
                        <li> <a href='{{url('/restrito')}}'>SINAE</a> </li>
                        <li class='active'> <a href='{{url('/restrito/minha-area/ministros-missionarias')}}'>MINISTROS E MISSIONÁRIAS</a> </li>
                    </ol>
                </h4>
            </div>
            <h4 class='page-title'>MINISTROS E MISSIONÁRIAS | <small>GERENCIAMENTO DE REGISTROS</small></h4>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        <div class='card-box table-responsive'>
            <table id='datatable' class='table table-striped table-bordered text-uppercase'>
                <thead>
                    <tr>
                        <th width='50px'>MATR.</th>
                        <th width='20px'></th>
                        <th width='60px'></th>
                        <th>NOME</th>
                        <th width='100px'>CPF</th>
                        <th width='20px'></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $registro)
                    <tr>
                        <td>{{$registro->matricula}}</td>
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
                        <td style='text-align: center'>
                            @if($registro->tp=='MIN')
                            <span class='label label-default'>MINISTRO</span>
                            @else
                            <span class='label label-pink'>MISSIONÁRIA</span>
                            @endif
                        </td>
                        <td>{{$registro->name}}</td>
                        <td>{{$registro->cpf}}</td>
                        <!-- ENDEREÇO -->
                        <td style='text-align: center'>
                            @if(isset($registro->END_CODIGO))
                            <a href='{{url("/restrito/minha-area/usuarios/enderecos/editar/$registro->END_CODIGO")}}'
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
                            <a href='{{url("/restrito/minha-area/usuarios/enderecos/cadastrar/$registro->id")}}' 
                               class='btn btn-xs btn-primary waves-effect waves-light tooltip-hover'  
                               title='Adicionar o endereço' >
                                <i class='mdi mdi-map-marker-plus'></i>
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