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
        <script> window.Sinae = <?php echo json_encode([ 'csrfToken' => csrf_token(),]); ?></script>

        <!-- App css -->
        <link href='{{url('/assets/css/bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/core.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/components.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/icons.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/pages.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/menu.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/responsive.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/app.css')}}' rel='stylesheet' type='text/css' />
        <link rel='stylesheet' href='{{url('/assets/plugins/switchery/switchery.min.css')}}'>

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src='{{url('/assets/js/modernizr.min.js')}}'></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="wrapper-page">
                            <img src="{{url('assets/images/animat-customize-color.gif')}}" alt="" height="120" />
                            <h1 style="font-size: 78px;">404</h1>
                            <h3 class="text-uppercase text-danger">PÁGINA NÃO ENCONTRADA</h3>
<!--                            <p class="text-muted">Página não encontrada 
                                <a href="extras-contact.html" class="text-primary">support</a>
                            </p>-->



                            <a class="btn btn-success waves-effect waves-light m-t-20" onclick="goBack()" href="#"> Voltar a Página Anterior</a>
                            <script>
                                function goBack() {
                                    window.history.back();
                                }
                            </script>


                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->

        <script>
            var resizefunc = [];</script>

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



        <!-- App js -->
        <script src='{{url('/assets/js/jquery.core.js')}}'></script>
        <script src='{{url('/assets/js/jquery.app.js')}}'></script>

    </body>
</html>