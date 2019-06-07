<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administrador Sistema de Monitoreo de Procesos - Grupo Prisma</title>
	@yield('encabezado')
	
    <link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/masterPage.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons-align.css')}}">
    <script src="{{asset('js/toggle.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://revistas.ucr.ac.cr/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="./css/base.css" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

	<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/CK7DC5QN.json?segment=placement:eonasdangithubio&amp;callback=_carbonads_go"></script></head>
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body lcass="body">
<nav class="navbar navbar-default navbar-static-top ">
  <div class="container-fluid">
  <a class="navbar-toggler pull-right" href="#menu-toggle" id="menu-toggle"><span style=" font-size: 25px; margin-top:13px; color:white;" class="glyphicon glyphicon-menu-hamburger"></a>
    <a class="navbar-brand font-color" style="margin-left:50px" href="#">Sistema de Monitoreo</a>
  </div>
</nav>
   <div id="wrapper" >
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
		
            <ul class="sidebar-nav">
				
            		<li>
		      			<a class="border font-color" href="{{ url('admin_accounts_index') }}">Cuentas<span class="glyphicon glyphicon-user right-aling-glyphicon-cuentas"></a>
					</li>
					<li>
		      			<a class="border font-color">Trabajos<span class="glyphicon glyphicon-folder-open right-aling-glyphicon-trabajos"></a>
		    		</li>
					<li>
		      			<a class="border font-color" href="{{ url('admin_clients_index') }}">Clientes<span class="glyphicon glyphicon-comment right-aling-glyphicon-clientes"></a>
		    		</li>
		    		<li>
		      			<a class="border font-color" href="{{ url('estados') }}">Estados<span class="glyphicon glyphicon glyphicon-tags right-aling-glyphicon-estados"></a>
		    		</li>
		    		<li>
		      			<a class="border font-color">Visitas<span class="glyphicon glyphicon-home right-aling-glyphicon-visitas"></a>
		    		</li>
					<li>
						<a class="border font-color" href="{{ url('contrasennaAdmin') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-glyphicon-contrasenna"></a>
				  	</li>
		    		<li class="hide-button-side">
		      			<a class="border font-color" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-logout"></a>
                    </li>
                    <br>
                    <br>
		    		<li>	
      					<div class="logo_prisma_sidebar"><img src="{{asset('Imagenes/prisma_logo.png')}}"style="width:120px; height:120px;"></div>
      				</li>    			
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                    @yield('contenido_Admin')	
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{@session('error')}}
                    </div>
                    @endif
                    </div>
                </div>
            </div>
                    <!-- /#page-content-wrapper -->
        <footer class="main-footer" style="text-align:center;">
            <div class="text-center " >
                <a style="font-size:1em; color:#30A8D8; "><strong>Grupo Prisma ©2019</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/prisma_footer.png')}}" >
            </div>
            </footer>
        </div>

        </div>
      
</body>
    <!-- /#wrapper -->
     <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
	});
	
    </script>
<html>