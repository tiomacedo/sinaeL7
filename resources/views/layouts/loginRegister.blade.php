<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
        <meta name='author' content='BemFuncional'/>
        <link rel='shortcut icon' href='{{url('/assets/images/favicon.png')}}' />
        <link href='{{url('/assets/images/favicon.144x144.png')}}' rel='apple-touch-icon' type='image/png' sizes='144x144'/>
        <link href='{{url('/assets/images/favicon.114x114.png')}}' rel='apple-touch-icon' type='image/png' sizes='114x114'/>
        <link href='{{url('/assets/images/favicon.72x72.png')}}' rel='apple-touch-icon' type='image/png' sizes='72x72'/>
        <link href='{{url('/assets/images/favicon.57x57.png')}}' rel='apple-touch-icon' type='image/png'/>
        <link href='{{url('/assets/images/favicon.png')}}' rel='icon' type='image/png'/>
        
        <title>{{'SINAE - Sistema Integrado de Administração Eclesiática'}}</title>
        <link href='{{url('/assets/css/bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/core.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/components.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/icons.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/pages.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/menu.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/responsive.css')}}' rel='stylesheet' type='text/css' />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}'></script>
        <![endif]-->
        <script src='{{url('/assets/js/modernizr.min.js')}}'></script>
    </head>
    <body class='bg-transparent'>
        <section>
            <div class='container-alt'>
                @yield('content')
            </div>
        </section>
        <script> var resizefunc = [];</script>
        <script src='{{url('/assets/js/jquery.min.js')}}'></script>
        <script src='{{url('/assets/js/bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/js/detect.js')}}'></script>
        <script src='{{url('/assets/js/fastclick.js')}}'></script>
        <script src='{{url('/assets/js/jquery.blockUI.js')}}'></script>
        <script src='{{url('/assets/js/waves.js')}}'></script>
        <script src='{{url('/assets/js/jquery.slimscroll.js')}}'></script>
        <script src='{{url('/assets/js/jquery.scrollTo.min.js')}}'></script>
        <script src='{{url('/assets/js/jquery.core.js')}}'></script>
        <script src='{{url('/assets/js/jquery.app.js')}}'></script>

    </body>
</html>