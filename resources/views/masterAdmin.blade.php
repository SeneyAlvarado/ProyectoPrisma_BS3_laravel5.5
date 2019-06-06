<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administrador Sistema de Monitoreo de Procesos - Grupo Prisma</title>
	@yield('encabezado')
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://revistas.ucr.ac.cr/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="./css/base.css" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
	<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/CK7DC5QN.json?segment=placement:eonasdangithubio&amp;callback=_carbonads_go"></script></head>
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body class="bg-color">

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a id="menu-toggle" href="#" class="navbar-toggle" onclick="menu-toggle">
				<span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
				</a>
				<div ><img class="img-responsive" style="margin-top: 15px; margin-left: 80px;" class="" src="{{asset('Imagenes/grupo_prisma3.png')}}" ></div>
				<!--h1 style="font-size:1.5vw; margin-left: 80px; margin-top: 15px; color:white">Administrador</h1--> 
			</div>

			<ul class="nav navbar-nav navbar-right hide-button" >
				 <li>
				 <!--data-toggle="dropdown"-->
                    <a href="{{ url('/logout') }}" class="dropdown-toggle logout-button"style="color:white" >
                         Salir&nbsp<span class="glyphicon glyphicon-log-out" style="color:white"></span> 
                    </a>  
                </li>
        	</ul>

			<div id="sidebar-wrapper" class="sidebar-toggle sidebar">
				<ul class="sidebar-nav">
		    		<li>
		      			<a class="border">Cuentas<span class="glyphicon glyphicon-user right-aling-glyphicon-cuentas"></a>
					</li>
					<li>
		      			<a class="border">Trabajos<span class="glyphicon glyphicon-folder-open right-aling-glyphicon-trabajos"></a>
		    		</li>
					<li>
		      			<a class="border" href="{{ url('admin_clients_index') }}">Clientes<span class="glyphicon glyphicon-comment right-aling-glyphicon-clientes"></a>
		    		</li>
		    		<li>
		      			<a class="border">Estados<span class="glyphicon glyphicon glyphicon-tags right-aling-glyphicon-estados"></a>
		    		</li>
		    		<li>
		      			<a class="border">Visitas<span class="glyphicon glyphicon-home right-aling-glyphicon-visitas"></a>
		    		</li>
					<li>
						<a class="border" href="{{ url('contrasennaAdmin') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-glyphicon-contrasenna"></a>
				  	</li>
		    		<li class="hide-button-side">
		      			<a class="border" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-logout"></a>
		    		</li>
		    		<li>	
      					<div class="logo_prisma_sidebar"><img src="{{asset('Imagenes/prisma_logo.png')}}"style="width:120px; height:120px;"></div>
      				</li>    			
		  		</ul>
			</div>
  		</div>
	</nav>

	<div class="sidebar-mobile">       
      <div>      
        <button type="button" class="navbar-toggle collapsed border-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
        </button>
            <a style="height: 50px" class="border-a active hide-title tittle-mobile" href="admin"><img style="display: block; margin-top:6px; margin-left: auto; margin-right: auto;" class="img-responsive center logo-nombre" height="20" width="200"  src="{{asset('Imagenes/grupo_prisma3.png')}}" ></a>
      </div>

      <div id="myNavbar" class="collapse">
		<a class="border-a" href="cuentas">Cuentas<span class="glyphicon glyphicon-user right-aling-glyphicon-cuentas"></a>
		<a class="border-a" >Trabajos<span class="glyphicon glyphicon-folder-open right-aling-glyphicon-trabajos"></a>
		<a class="border-a" >Clientes<span class="glyphicon glyphicon glyphicon-comment right-aling-glyphicon-clientes"></a>
		<a class="border-a" >Estados<span class="glyphicon glyphicon-tags right-aling-glyphicon-estados"></a>
		<a class="border-a">Visitas<span class="glyphicon glyphicon-home right-aling-glyphicon-visitas"></a>
		<a class="border-a" href="{{ url('contrasennaAdmin') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-glyphicon-contrasenna"></a>
		<a class="border-a hide-button-exit" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-logout"></a>
      </div>
    </div>

	<div class="panel-heading">
		<div class="content w3-container">
			@yield('contenido_Admin')	
			@if(session('error'))
			<div class="alert alert-danger alert-dismissible" style="text-align: center" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				{{@session('error')}}
			</div>
			@endif
		</div>
	</div>
	
	
    <footer class="main-footer">
  	<div class="text-center main-footer">
    	<a style="font-size:1em; color:#30A8D8;"><strong>Grupo Prisma ©2019</strong></a><img style="margin-top: 4px;" class="margin-logo" src="{{asset('Imagenes/prisma_footer.png')}}" >
  	</div>
	</footer>

	<script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<!-- AdminLTE App -->
		<!--Aquí había un import asset de js/app.min.js, lo quité porque no existe, si algo no sirve puede ser eso -->

	</body>

</html>