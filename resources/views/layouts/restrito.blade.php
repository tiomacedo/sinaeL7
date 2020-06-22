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
        <title>{{'SINAE - Sistema Integrado de Administração Eclesiática'}}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script> window.Sinae = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
        <!-- alerts -->
        <link href='{{url('/assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/tooltipster/tooltipster.bundle.min.css')}}' rel='stylesheet' type='text/css' />

        <!-- App css -->
        <link href='{{url('/assets/css/bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/core.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/components.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/icons.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/pages.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/menu.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/responsive.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/app.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/switchery/switchery.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/toastr/toastr.min.css')}}' rel='stylesheet' type='text/css' />
        <!-- DataTables -->
        <link href='{{url('/assets/plugins/datatables/jquery.dataTables.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/buttons.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/dataTables.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/responsive.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/scroller.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/dataTables.colVis.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/fixedColumns.dataTables.min.css')}}' rel='stylesheet' type='text/css' />
        <!-- forms -->
        <link href='{{url('/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}'  rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/multiselect/css/multi-select.css')}}'  rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/select2/css/select2.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}' rel='stylesheet'  type='text/css'  />
        <link href='{{url('/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}' rel='stylesheet'  type='text/css' />
        @stack('css')
        @stack('js-topo')
        <link href='{{url('/assets/plugins/custombox/css/custombox.min.css')}}' rel='stylesheet' type='text/css' />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}'></script>
        <![endif]-->
        <script src='{{url('/assets/js/modernizr.min.js')}}'></script>
    </head>

    <body>
        <!-- Navigation Bar-->
        <header id='topnav'>
            <div class='topbar-main'>
                <div class='container'>
                    <div class='logo'>
                        <a href='{{url('/restrito')}}' class='logo'>
                            <img src='{{url('/assets/images/logo.png')}}' alt='' height='60'/>
                        </a>
                    </div>
                    <div class='menu-extras'>
                        <ul class='nav navbar-nav navbar-right pull-right'>
                            <!--                            <li class='dropdown navbar-c-items'>
                                                             <a href='#' class='right-menu-item dropdown-toggle' data-toggle='dropdown'>
                                                                <i class='mdi mdi-bell'></i>
                                                                <span class='badge up bg-success'>4</span>
                                                            </a>

                                                            <ul class='dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list'>
                                                                <li class='text-center'>
                                                                    <h5>Notifications</h5>
                                                                </li>
                                                                <li>
                                                                    <a href='#' class='user-list-item'>
                                                                        <div class='icon bg-info'>
                                                                            <i class='mdi mdi-account'></i>
                                                                        </div>
                                                                        <div class='user-desc'>
                                                                            <span class='name'>New Signup</span>
                                                                            <span class='time'>5 hours ago</span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href='#' class='user-list-item'>
                                                                        <div class='icon bg-danger'>
                                                                            <i class='mdi mdi-comment'></i>
                                                                        </div>
                                                                        <div class='user-desc'>
                                                                            <span class='name'>New Message received</span>
                                                                            <span class='time'>1 day ago</span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href='#' class='user-list-item'>
                                                                        <div class='icon bg-warning'>
                                                                            <i class='mdi mdi-settings'></i>
                                                                        </div>
                                                                        <div class='user-desc'>
                                                                            <span class='name'>Settings</span>
                                                                            <span class='time'>1 day ago</span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li class='all-msgs text-center'>
                                                                    <p class='m-0'><a href='#'>See all Notification</a></p>
                                                                </li>
                                                            </ul>
                                                        </li>-->






                            <li class="dropdown navbar-c-items">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true">
                                    @if (Auth::user()->foto)
                                    <img src="{{url('/')}}/assets/users/{{Auth::user()->foto}}" alt="user-img" class="img-circle">
                                    @else
                                    <img src="{{url('/assets/users/not_img.jpg')}}" alt="user-img" class="img-circle">
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li class="text-center">
                                        @php $shortName = explode(" ", (Auth::user()->name)) @endphp
                                        <h5>Olá, {{$shortName[0]}}</h5>
                                    </li>

                                    <li><a href='{{url("/restrito/meu-perfil")}}'><i class="ti-user m-r-5"></i> Meu perfil</a></li>
                                    <!--<li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>-->
                                    <!--<li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>-->

                                    @if (Auth::guest())
                                    <li></li>
                                    @else

                                    <li>
                                        <a href='{{url('/logout')}}' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="ti-power-off m-r-5"></i> Logout</a>
                                        </a>
                                    </li>
                                    @endif


                                </ul>

                            </li>


                        </ul>
                        <div class='menu-item'>
                            <!-- Mobile menu toggle-->
                            <a class='navbar-toggle'>
                                <div class='lines'>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>
                    <!-- end menu-extras -->
                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class='navbar-custom'>
                <div class='container'>
                    <div id='navigation'>






                        <!-- Navigation Menu-->
                        <ul class='navigation-menu p-0'>

                            @can('GERENCIAMENTO INSTITUCIONAL')
                            <li class='has-submenu'>
                                <a href='{{url('/restrito/institucional')}}'><i class='fa fa fa-fort-awesome'></i>Institucional</a>
                            </li>
                            @endcan



                            @can('GERENCIAMENTO DE AREAS E IGREJAS')
                            <li class='has-submenu p-0'>

                                <a href='#'><i class='mdi mdi-church'></i>Áreas e Igrejas</a>
                                <ul class='submenu p-0'>
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/areas')}}'>
                                            <i class='mdi mdi-google-maps'></i> Áreas
                                        </a>
                                    </li>
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/igrejas')}}'>
                                            <i class='mdi mdi-church'></i> Igrejas
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            @endcan




                            @can('GERENCIAMENTO USUARIOS')
                            <li class='has-submenu'>
                                <a href='#'><i class='mdi mdi-account-multiple'></i>Usuários</a>
                                <ul class='submenu megamenu'>
                                    <li>
                                        <ul>
                                            <li>
                                                <span>TIPOS DE USUÁRIOS</span>
                                            </li>
                                            <li>
                                                <a class='waves-effect waves-grey' href='{{url('/restrito/ministros')}}'>
                                                    <i class='mdi mdi-account'></i> Ministros
                                                </a>
                                            </li>
                                            <li>
                                                <a class='waves-effect waves-grey' href='{{url('/restrito/missionarias')}}'>
                                                    <i class='mdi mdi-account-outline'></i> Missionárias
                                                </a>
                                            </li>
                                            @can('ADMIN')
                                            <li>
                                                <a class='waves-effect waves-grey' href='{{url('/restrito/usuarios-deletados')}}'>
                                                    <i class='mdi mdi-account-outline'></i> Usuários Deletados
                                                </a>
                                            </li>
                                            @endcan
                                        </ul>
                                    </li>



                                    @can('GERENCIAMENTO DE CREDENCIAIS')
                                    <li>
                                        <ul>
                                            @can('GERENCIAMENTO FULL-USERS')
                                            <li>
                                                <span>PERFIS E PERMISSÕES</span>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey' href="{{url('/restrito/perfil-usuario')}}">
                                                    <i class='fa fa-unlock'></i> Permissões dos Usuários
                                                </a>
                                            </li>
                                            @endcan
                                            @can('SUPERADMIN')
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey' href="{{url('/restrito/permissao-perfil')}}">
                                                    <i class='fa fa-lock'></i> Permissões dos Papéis
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey' href="{{url('/restrito/perfil')}}">
                                                    <i class='fa fa-user-secret'></i>  Tipos de Papéis
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey' href="{{url('/restrito/permissao')}}">
                                                    <i class='fa fa-lock'></i> Tipos de Permissões
                                                </a>
                                            </li>
                                            @endcan

                                            @can('GERENCIAMENTO DE CREDENCIAIS')
                                            <li>
                                                <span>CREDENCIAIS</span>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey red-text' href='{{url('/restrito/credencial/ministros')}}'>
                                                    <i class='mdi mdi-account-card-details'></i> Cartão Ministros
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey red-text' href='{{url('/restrito/credencial/uemads')}}'>
                                                    <i class='mdi mdi-account-card-details'></i> Cartão Uemads
                                                </a>
                                            </li>
                                            @endcan
                                        </ul>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan

                            @can('GERENCIAMENTO DE EVENTOS')
                            <li class='has-submenu'>
                                <a href='#'><i class='mdi mdi-calendar-clock'></i>Eventos</a>
                                <ul class='submenu'>
                                    <li class='no-padding'>
                                        <a class='waves-effect waves-grey red-text' href='{{url('/restrito/eventos/ago')}}'>
                                            <i class='fa fa-calendar-times-o'></i>
                                            AGO's
                                        </a>
                                    </li>
                                    <li class='no-padding'>
                                        <a class='waves-effect waves-grey red-text' href='{{url('/restrito/eventos/age')}}'>
                                            <i class='fa fa-calendar-times-o'></i>
                                            AGE's
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endcan



                            @can('GERENCIAMENTO CONTABIL')
                            <li class='has-submenu'>
                                <a href='#'><i class='mdi mdi-coin'></i>Contabilidade</a>
                                <ul class='submenu megamenu'>
                                    <li>
                                        <ul>
                                            <li>
                                                <span>RECEITAS</span>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas-tipo')}}'>
                                                    <i class='fa fa-arrow-circle-o-up'></i> Modalidades Entrada
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas')}}'>
                                                    <i class='fa fa-arrow-circle-o-up'></i> Entradas
                                                </a>
                                            </li>
                                            <!--
                                            <li><hr/></li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas/boletos')}}'>
                                                    <i class='fa fa-barcode'></i> Boletos
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas/recibos')}}'>
                                                    <i class='fa fa-file-text-o'></i> Recibos
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas/boletos-pendentes')}}'>
                                                    Boletos Pendentes
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas/boletos-vencidos')}}'>
                                                    Boletos Vencidos
                                                </a>
                                            </li>

                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey blue-text' href='{{url('/restrito/receitas/gerar-boletos')}}'>
                                                    Gerar Boletos
                                                </a>
                                            </li>
                                            -->
                                            <li>
                                                <span>  </span>
                                            </li>
                                            <li>
                                                <span>BENS</span>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey red-text' href='{{url('/restrito/patrimonios')}}'>
                                                    <i class='mdi mdi-diamond'></i> Patrimônios
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li>
                                        <ul>
                                            <li>
                                                <span>DÉBITOS</span>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey red-text' href='{{url('/restrito/debitos-tipo')}}'>
                                                    <i class='fa fa-arrow-circle-o-down text-danger'></i> Modalidades Débito
                                                </a>
                                            </li>
                                            <li class='no-padding'>
                                                <a class='waves-effect waves-grey red-text' href='{{url('/restrito/debitos')}}'>
                                                    <i class='fa fa-arrow-circle-o-down text-danger'></i> Débitos
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            @endcan

                            @can('MINHA ÁREA')
                            <li class='has-submenu'>
                                <a href='#'><i class='fa fa-area-chart'></i>Minha Área</a>
                                <ul class='submenu'>
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/minha-area/ministros-missionarias')}}'>
                                            <i class='mdi mdi-account'></i> Ministros e Missionárias
                                        </a>
                                    </li>
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/minha-area/igrejas')}}'>
                                            <i class='mdi mdi-church'></i> Igrejas da Área
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            @endcan

                            @can('MINHAS FINANCAS')
                            <li class='has-submenu'>
                                <a href='#'><i class='fa fa-money'></i>Finanças</a>
                                <ul class='submenu'>
                                    <!--
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/meus-boletos')}}'>
                                            <i class='fa fa-barcode'></i> Meus boletos
                                        </a>
                                    </li>
                                    -->
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/minhas-contribuicoes')}}'>
                                            <i class='fa fa-barcode'></i> Minhas contribuições
                                        </a>
                                    </li>
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/meus-recibos')}}'>
                                            <i class='fa fa-file-text-o'></i> Meus Recibos
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            @endcan

                            @can('TRANSPARENCIA')
                            <li class='has-submenu'>
                                <a href='{{url('/restrito/transparencia')}}'><i class='fa fa-pie-chart'></i>Transparência</a>
                            </li>
                            @endcan
                            <li class='has-submenu'>
                                <a href='#'><i class='mdi mdi-comment-multiple-outline'></i>Solicitações</a>
                                <ul class='submenu'>
                                    @can('FAZER SOLICITACAO')
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/solicitacao')}}'>
                                            <i class='mdi mdi-comment-multiple-outline'></i> Fazer Solicitação
                                        </a>
                                    </li>
                                    @endcan
                                    @can('RESPONDER SOLICITACAO')
                                    <li>
                                        <a class='waves-effect waves-grey' href='{{url('/restrito/solicitacao/responder')}}'>
                                            <i class='mdi mdi mdi-comment-check-outline'></i> Responder Solicitação
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class='has-submenu'>
                                <a href='{{url("/restrito/meu-perfil")}}'><i class="ti-user m-r-5"></i> Meus Dados</a></li>
                            </li>
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->

        <div class='wrapper' id="wrapper">
            <div class='container'>
                @yield('content')
                <!-- Footer -->
                <footer class='footer text-right'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-md-6'>
                                @foreach($institucionais as $DI)
                                © {{$DI->DI_NOMEFANTASIA}} - @php echo date('Y') @endphp. Todos direitos reservados.
                                <br/>{{$DI->DI_CIDADE}}/{{$DI->DI_UF}} - {{$DI->DI_FONE}}
                                @endforeach
                            </div>
                            <div class='col-md-6 text-right'>
                                <img src='{{url('/assets/images/bemfuncional.png')}}' alt='' />
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src='{{url('/assets/js/jquery.min.js')}}'></script>
        <script src='{{url('/assets/js/bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/js/detect.js')}}'></script>
        <script src='{{url('/assets/js/fastclick.js')}}'></script>
        <script src='{{url('/assets/js/jquery.blockUI.js')}}'></script>
        <script src='{{url('/assets/js/waves.js')}}'></script>
        <script src='{{url('/assets/js/jquery.slimscroll.js')}}'></script>
        <script src='{{url('/assets/js/jquery.scrollTo.min.js')}}'></script>
        <script src='{{url('/assets/plugins/switchery/switchery.min.js')}}'></script>
        <script src='{{url('/assets/js/MascaraValidacao.js')}}'></script>
        <!-- commons -->
        <script src='{{url('/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js')}}'></script>
        <script type='text/javascript' src='{{url('/assets/plugins/multiselect/js/jquery.multi-select.js')}}'></script>
        <script type='text/javascript' src='{{url('/assets/plugins/jquery-quicksearch/jquery.quicksearch.js')}}'></script>
        <script src='{{url('/assets/plugins/select2/js/select2.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}'type='text/javascript'></script>
        <!-- datatables js -->
        <script src='{{url('/assets/plugins/datatables/jquery.dataTables.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.bootstrap.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.buttons.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/buttons.bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/responsive.bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/jszip.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/pdfmake.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/vfs_fonts.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/buttons.html5.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/buttons.print.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.fixedHeader.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.keyTable.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.responsive.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.scroller.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.colVis.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.fixedColumns.min.js')}}'></script>
        <!-- custom box js -->
        <script src='{{url('/assets/plugins/custombox/js/custombox.min.js')}}'></script>
        <script src='{{url('/assets/plugins/custombox/js/legacy.min.js')}}'></script>
        <!-- alerts -->
        <script src='{{url('/assets/pages/jquery.sweet-alert.init.js')}}'></script>
        <script src='{{url('/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}'></script>
        <!-- masks -->
        <script src='{{url('/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}'></script>
        <script src='{{url('/assets/plugins/autoNumeric/autoNumeric.js')}}'></script>

        <script src='{{url('/assets/plugins/toastr/toastr.min.js')}}'></script>
        <script src='{{url('/assets/pages/jquery.toastr.js')}}'></script>
        <!-- Tooltipster js -->
        <script src='{{url('/assets/plugins/tooltipster/tooltipster.bundle.min.js')}}'></script>
        <script src='{{url('/assets/pages/jquery.tooltipster.js')}}'></script>
        <!-- init -->
        <script src='{{url('/assets/pages/jquery.datatables.init.js')}}'></script>
        <script type='text/javascript' src='{{url('/assets/pages/jquery.form-advanced.init.js')}}'></script>
        <!-- App js -->
        <script src='{{url('/assets/js/jquery.core.js')}}'></script>
        <script src='{{url('/assets/js/jquery.app.js')}}'></script>
        @stack('js-footer')
        <form id='logout-form' action='{{ url('/logout')}}' method='POST' style='display: none;'>
            {{ csrf_field() }}
        </form>
        <input type="hidden" id="token" value="{{csrf_token()}}"/>

        <script>

                                                                                                                                                                                                                                                                                                                                                                                                            function cadastrar(urlCadastrar) {
                                                                                                                                                                                                                                                                                                                                                                                                            jQuery("#form").attr("form-send", urlCadastrar);
                                                                                                                                                                                                                                                                                                                                                                                                            jQuery("#form").attr("action", urlCadastrar);
                                                                                                                                                                                                                                                                                                                                                                                                            erase();
//                jQuery('#modalForm').modal('show');
                                                                                                                                                                                                                                                                                                                                                                                                            }



                                                                                                                                                                                                                                                                                                                                                                                                    $(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#form').submit(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    var dadosForm = jQuery(this).serialize();
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.ajax({
                                                                                                                                                                                                                                                                                                                                                                                                    url: jQuery(this).attr('form-send'),
                                                                                                                                                                                                                                                                                                                                                                                                            data: dadosForm,
                                                                                                                                                                                                                                                                                                                                                                                                            method: 'POST',
                                                                                                                                                                                                                                                                                                                                                                                                            beforeSend: preloader()
                                                                                                                                                                                                                                                                                                                                                                                                    }).done(function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    if (data == '1') {
                                                                                                                                                                                                                                                                                                                                                                                                    console.log(data),
                                                                                                                                                                                                                                                                                                                                                                                                            erase(),
                                                                                                                                                                                                                                                                                                                                                                                                            $('#modalForm').modal('hide'),
                                                                                                                                                                                                                                                                                                                                                                                                            swal({
                                                                                                                                                                                                                                                                                                                                                                                                            title: 'Confirmado!',
                                                                                                                                                                                                                                                                                                                                                                                                                    text: 'O registro foi salvo com sucesso.',
                                                                                                                                                                                                                                                                                                                                                                                                                    type: 'success',
                                                                                                                                                                                                                                                                                                                                                                                                                    closeOnConfirm: true,
                                                                                                                                                                                                                                                                                                                                                                                                                    confirmButtonClass: 'btn-success',
                                                                                                                                                                                                                                                                                                                                                                                                                    confirmButtonText: 'Fechar'
                                                                                                                                                                                                                                                                                                                                                                                                            },
                                                                                                                                                                                                                                                                                                                                                                                                                    function (isConfirm) {
                                                                                                                                                                                                                                                                                                                                                                                                                    if (isConfirm) {
                                                                                                                                                                                                                                                                                                                                                                                                                    $("#datatable-buttons").load(location.href + " #datatable-buttons>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                                    $("#datatable").load(location.href + " #datatable>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                                    $("#solicitacoes").load(location.href + " #solicitacoes>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                                    //setTimeout('location.reload();', 1);
                                                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                                                                                                                    $("#datatable-buttons").load(location.href + " #datatable-buttons>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                                    $("#datatable").load(location.href + " #datatable>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                                    $("#solicitacoes").load(location.href + " #solicitacoes>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                                    //setTimeout('location.reload();', 3000);
                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    else {
                                                                                                                                                                                                                                                                                                                                                                                                    var idAppend = '#label-error-';
                                                                                                                                                                                                                                                                                                                                                                                                    $.each(data, function (key, value) {
                                                                                                                                                                                                                                                                                                                                                                                                    var nameDiv = '';
                                                                                                                                                                                                                                                                                                                                                                                                    var nameDiv = 'label-error-' + key;
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#' + nameDiv).empty();
                                                                                                                                                                                                                                                                                                                                                                                                    if ($('#' + nameDiv).is(':empty')) {
                                                                                                                                                                                                                                                                                                                                                                                                    $(idAppend + key).append(value);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery(idAppend + key).show();
                                                                                                                                                                                                                                                                                                                                                                                                    setTimeout(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    $('#' + nameDiv).empty();
                                                                                                                                                                                                                                                                                                                                                                                                    }, 10000);
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    }).fail(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    alert('Falha ao enviar dados');
                                                                                                                                                                                                                                                                                                                                                                                                    }).complete(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    endPreloader();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('.btn-cadastrar').click(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#form').attr('form-send', urlAdd);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#form').attr('action', urlAdd);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#form').each(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    this.reset();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    function edit(urlEditar) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlEditar, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function (key, val) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery(' *[name="' + key + '"] ').val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalForm').modal('show');
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#form").attr("form-send", urlEditar);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#form").attr("action", urlEditar);
                                                                                                                                                                                                                                                                                                                                                                                                    $("#solicitacoes").load(location.href + " #solicitacoes>*", "");
                                                                                                                                                                                                                                                                                                                                                                                                    erase();
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function editUser(urlEditar) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlEditar, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function (key, val) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery(' *[name="' + key + '"] ').val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalFormEdit').modal('show');
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#formEdit").attr("action", urlEditar);
                                                                                                                                                                                                                                                                                                                                                                                                    erase();
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function fot(urlFoto) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlFoto, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function (key, val) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery(' *[name="' + key + '"] ').val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalFormFoto').modal('show');
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#form").attr("form-send", urlFoto);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#form").attr("action", urlFoto);
                                                                                                                                                                                                                                                                                                                                                                                                    erase();
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function editEndereco(urlEditEndereco) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlEditEndereco, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function(key, val){
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("*[name='" + key + "']").val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormEndereco form").attr("form-send", urlEditEndereco);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormEndereco form").attr("action", urlEditEndereco);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalFormEndereco form').each(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    this.reset();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function editDE(urlDE) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlDE, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function(key, val){
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("*[name='" + key + "']").val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormDE form").attr("form-send", urlDE);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormDE form").attr("action", urlDE);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalFormDE form').each(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    this.reset();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function editDependente(urlDependente) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlDependente, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function(key, val){
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("*[name='" + key + "']").val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormDependente form").attr("form-send", urlDependente);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormDependente form").attr("action", urlDependente);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalFormDependente form').each(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    this.reset();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function editBank(urlBank) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlBank, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function(key, val){
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("*[name='" + key + "']").val(val);
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormBank form").attr("form-send", urlBank);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#modalFormBank form").attr("action", urlBank);
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery('#modalFormBank form').each(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    this.reset();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function viewDepententes(urlViewDependentes) {
                                                                                                                                                                                                                                                                                                                                                                                                    $("#dependenteFrame").attr("src", urlViewDependentes);
                                                                                                                                                                                                                                                                                                                                                                                                    return true;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function view(urlView) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.getJSON(urlView, function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery.each(data, function (key, text) {
                                                                                                                                                                                                                                                                                                                                                                                                    $(' *[id="SPAN_' + key + '"] ').text(text);
                                                                                                                                                                                                                                                                                                                                                                                                    if (typeof key != "undefined" && key == 'foto') {
                                                                                                                                                                                                                                                                                                                                                                                                    var foto = "/assets/users/" + text;
                                                                                                                                                                                                                                                                                                                                                                                                    $('#fotoImg').attr('src', foto);
                                                                                                                                                                                                                                                                                                                                                                                                    if (text == null || text == '') {
                                                                                                                                                                                                                                                                                                                                                                                                    var foto = "/assets/users/not_img.jpg";
                                                                                                                                                                                                                                                                                                                                                                                                    $('#fotoImg').attr('src', foto);
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function deletar(urlDeletar) {
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery("#urlDeletar").val(urlDeletar);
                                                                                                                                                                                                                                                                                                                                                                                                    swal({
                                                                                                                                                                                                                                                                                                                                                                                                    title: "Deseja deletar?",
                                                                                                                                                                                                                                                                                                                                                                                                            text: "Após exclusão você não será capaz de recuperar este arquivo.",
                                                                                                                                                                                                                                                                                                                                                                                                            type: "warning",
                                                                                                                                                                                                                                                                                                                                                                                                            showCancelButton: true,
                                                                                                                                                                                                                                                                                                                                                                                                            confirmButtonClass: "btn red",
                                                                                                                                                                                                                                                                                                                                                                                                            confirmButtonText: "Sim, remova!",
                                                                                                                                                                                                                                                                                                                                                                                                            cancelButtonClass: "btn white",
                                                                                                                                                                                                                                                                                                                                                                                                            cancelButtonText: "Cancelar",
                                                                                                                                                                                                                                                                                                                                                                                                            closeOnConfirm: false,
                                                                                                                                                                                                                                                                                                                                                                                                            closeOnCancel: false
                                                                                                                                                                                                                                                                                                                                                                                                    },
                                                                                                                                                                                                                                                                                                                                                                                                            function (isConfirm) {
                                                                                                                                                                                                                                                                                                                                                                                                            if (isConfirm) {
                                                                                                                                                                                                                                                                                                                                                                                                            erase();
                                                                                                                                                                                                                                                                                                                                                                                                            var urlDeletar = jQuery("#urlDeletar").val();
                                                                                                                                                                                                                                                                                                                                                                                                            var csrf = jQuery("#token").val();
                                                                                                                                                                                                                                                                                                                                                                                                            jQuery.ajax({
                                                                                                                                                                                                                                                                                                                                                                                                            url: urlDeletar,
                                                                                                                                                                                                                                                                                                                                                                                                                    method: 'POST',
                                                                                                                                                                                                                                                                                                                                                                                                                    data: {'_token': csrf},
                                                                                                                                                                                                                                                                                                                                                                                                                    beforeSend: preloader()
                                                                                                                                                                                                                                                                                                                                                                                                            }).done(function (data) {
                                                                                                                                                                                                                                                                                                                                                                                                            if (data == "1") {
                                                                                                                                                                                                                                                                                                                                                                                                            swal({
                                                                                                                                                                                                                                                                                                                                                                                                            title: "Excluido!",
                                                                                                                                                                                                                                                                                                                                                                                                                    text: "Seu arquivo foi excluído com sucesso!",
                                                                                                                                                                                                                                                                                                                                                                                                                    type: "success",
                                                                                                                                                                                                                                                                                                                                                                                                                    confirmButtonClass: "btn-success"
                                                                                                                                                                                                                                                                                                                                                                                                            });
                                                                                                                                                                                                                                                                                                                                                                                                            setTimeout('location.reload();', 0);
//                                    $("#datatable-buttons").load(location.href+" #datatable-buttons>*","");
//                                    $("#datatable").load(location.href+" #datatable>*","");
//                                    $("#solicitacoes").load(location.href+" #solicitacoes>*","");
                                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                            jQuery(".errors-msg-delete").html(data);
                                                                                                                                                                                                                                                                                                                                                                                                            jQuery(".errors-msg-delete").show();
                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                            }).fail(function () {
                                                                                                                                                                                                                                                                                                                                                                                                            alert('Falha deletar arquivo.');
                                                                                                                                                                                                                                                                                                                                                                                                            }).complete(function () {
                                                                                                                                                                                                                                                                                                                                                                                                            endPreloader();
                                                                                                                                                                                                                                                                                                                                                                                                            });
                                                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                                            swal({
                                                                                                                                                                                                                                                                                                                                                                                                            title: "Cancelado!",
                                                                                                                                                                                                                                                                                                                                                                                                                    text: "Seu arquivo está seguro.",
                                                                                                                                                                                                                                                                                                                                                                                                                    type: "error",
                                                                                                                                                                                                                                                                                                                                                                                                                    confirmButtonClass: "btn red"
                                                                                                                                                                                                                                                                                                                                                                                                            });
                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                            });
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function preloader() {
                                                                                                                                                                                                                                                                                                                                                                                                    //setTimeout('location.reload();', 1500);
//                    $( "#result" ).load( "ajax/test.html" )
//                    $().load("<div id='preloader'><div id='status'><div class='spinner'><div class='spinner-wrapper'><div class='rotator'><div class='inner-spin'></div><div class='inner-spin'></div></div></div></div></div></div>");
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    function endPreloader() {
//                    $("#preloader").append("<div class='progress progress-md'><div class='progress-bar progress-bar-pink' role='progressbar' aria-valuenow='98' aria-valuemin='0' aria-valuemax='100' style='width: 98%;'>98%</div></div>");
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    function erase() {
                                                                                                                                                                                                                                                                                                                                                                                                    $('#form').each(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    this.reset();
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                                                                                                                                    $(document).ready(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    $('#datatable').dataTable();
                                                                                                                                                                                                                                                                                                                                                                                                    $("#close").click(function (){
                                                                                                                                                                                                                                                                                                                                                                                                    $('#form').removeAttr('action');
                                                                                                                                                                                                                                                                                                                                                                                                    $('#form').removeAttr('form-send');
                                                                                                                                                                                                                                                                                                                                                                                                    $('#form').removeAttr('selected');
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    $(window).load(function() {
                                                                                                                                                                                                                                                                                                                                                                                                    $("label").removeClass();
                                                                                                                                                                                                                                                                                                                                                                                                    $("label").addClass("active");
                                                                                                                                                                                                                                                                                                                                                                                                    });
        </script>


        <script type="text/javascript">
                                                                                                                                                                                                                                                                                                                                                                                                    $(document).ready(function () {
                                                                                                                                                                                                                                                                                                                                                                                                    $('#datatable').dataTable();
                                                                                                                                                                                                                                                                                                                                                                                                    $('#datatable-keytable').DataTable({keys: true});
                                                                                                                                                                                                                                                                                                                                                                                                    $('#datatable-responsive').DataTable();
                                                                                                                                                                                                                                                                                                                                                                                                    $('#datatable-colvid').DataTable({
                                                                                                                                                                                                                                                                                                                                                                                                    "dom": 'C<"clear">lfrtip',
                                                                                                                                                                                                                                                                                                                                                                                                            "colVis": {
                                                                                                                                                                                                                                                                                                                                                                                                            "buttonText": "Change columns"
                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    $('#datatable-scroller').DataTable({
                                                                                                                                                                                                                                                                                                                                                                                                    ajax: "../plugins/datatables/json/scroller-demo.json",
                                                                                                                                                                                                                                                                                                                                                                                                            deferRender: true,
                                                                                                                                                                                                                                                                                                                                                                                                            scrollY: 380,
                                                                                                                                                                                                                                                                                                                                                                                                            scrollCollapse: true,
                                                                                                                                                                                                                                                                                                                                                                                                            scroller: true
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                                                                                                                                                                                                                                                                                                                                                                                                    var table = $('#datatable-fixed-col').DataTable({
                                                                                                                                                                                                                                                                                                                                                                                                    scrollY: "300px",
                                                                                                                                                                                                                                                                                                                                                                                                            scrollX: true,
                                                                                                                                                                                                                                                                                                                                                                                                            scrollCollapse: true,
                                                                                                                                                                                                                                                                                                                                                                                                            paging: false,
                                                                                                                                                                                                                                                                                                                                                                                                            fixedColumns: {
                                                                                                                                                                                                                                                                                                                                                                                                            leftColumns: 1,
                                                                                                                                                                                                                                                                                                                                                                                                                    rightColumns: 1
                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    });
                                                                                                                                                                                                                                                                                                                                                                                                    TableManageButtons.init();
        </script>
        <script type="text/javascript">
                                                                                                                                                                                                                                                                                                                                                                                                    jQuery(function($) {
                                                                                                                                                                                                                                                                                                                                                                                                    $('.autonumber').autoNumeric('init');
                                                                                                                                                                                                                                                                                                                                                                                                    });
        </script>



    </body>
</html>