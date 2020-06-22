<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
        <meta name='description' content='Sistema de administração eclesiásticas da CIMADSETA'/>
        <meta name='author' content='BemFuncional'/>

        <link rel='shortcut icon' href='{{url('/assets/images/favicon.png')}}' />
        <link href='{{url('/assets/images/favicon.144x144.png')}}' rel='apple-touch-icon' type='image/png' sizes='144x144'/>
        <link href='{{url('/assets/images/favicon.114x114.png')}}' rel='apple-touch-icon' type='image/png' sizes='114x114'/>
        <link href='{{url('/assets/images/favicon.72x72.png')}}' rel='apple-touch-icon' type='image/png' sizes='72x72'/>
        <link href='{{url('/assets/images/favicon.57x57.png')}}' rel='apple-touch-icon' type='image/png'/>
        <link href='{{url('/assets/images/favicon.png')}}' rel='icon' type='image/png'/>

        <link href='{{url('/assets/css/credencial.css')}}' rel='stylesheet' type='text/css' />
        <title>SINAE - Sistema Integrado de Administração Eclesiática</title>
    </head>


    <body>
        @forelse($data as $registro)
        <div class='bg-mis-frente text-uppercase'>

            <div class='info-miss'>
                <p class='matricula-mis'>{{$registro->matricula}}</p>
                <p class='name-mis'>{{$registro->name}}</p>
                <p class='atividade-mis'>{{$registro->DEM_ATIVIDADE}}</p>
                <p class='filiacao-mis'>
                    @if(isset($registro->DEM_DTFILIACAO) && $registro->DEM_DTFILIACAO != null )
                    {{ \Carbon\Carbon::parse($registro->DEM_DTFILIACAO)->format('d/m/Y')}}
                    @endif
                </p>
                <p class='rg-mis'>{{$registro->rg}}</p>
                <p class='cpf-mis'>{{$registro->cpf}}</p>
                <p class='emissao-mis'>
                    {{ \Carbon\Carbon::parse($registro->CREDEN_DTEMISSAO)->format('d/m/Y')}}
                </p>
                <p class='validade-mis'>
                    {{ \Carbon\Carbon::parse($registro->CREDEN_DTVALIDADE)->format('d/m/Y')}}
                </p>
                <p class='conjuge-mis'>{{$registro->conjuge}}</p>

                <div class='consagracao'>
                    @if(isset($registro->DEM_DTCONSAGRACAO) && $registro->DEM_DTCONSAGRACAO != null )
                    {{ \Carbon\Carbon::parse($registro->DEM_DTCONSAGRACAO)->format('d/m/Y')}}
                    @endif
                </div>
                <div class='ordenacao'>
                    @if(isset($registro->DEM_DTORDENACAO) && $registro->DEM_DTORDENACAO != null )
                    {{ \Carbon\Carbon::parse($registro->DEM_DTORDENACAO)->format('d/m/Y')}}
                    @endif
                </div>
            </div>
            <div class='img-miss'>
                @if(isset($registro->foto) && $registro->foto!='' && $registro->foto!=null)
                <img src='{{url("/assets/users/$registro->foto")}}' 
                     alt="contact-img" title="contact-img" class="foto-mis" />
                @else
                <img src='{{url("/assets/users/not_img.jpg")}}' 
                     alt="contact-img" title="contact-img" class="foto-mis" />
                @endif
            </div>
        </div>

        <div class="page-break"></div>

        <div class='bg-mis-verso text-uppercase'>
            <div class="visible-print text-center qr-code-mis">
                {!! QrCode::size(50)->margin(2)->generate($registro->matricula); !!}
            </div>            
        </div>

        <div class='fone-mis'>
            Fone: {{$fone}}
        </div>



        @empty
        Nenhum dado inserido até o momento
        @endforelse
    </body>
</html>