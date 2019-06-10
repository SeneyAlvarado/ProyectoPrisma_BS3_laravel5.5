<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/master-page.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons-align.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="{{asset('js/master-page.js')}}"></script>
  <script src="{{asset('js/sidebarWrapperSize.js')}}"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
  <link href="./css/base.css" rel="stylesheet">


  <script async="" src="//www.google-analytics.com/analytics.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
  <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/CK7DC5QN.json?segment=placement:eonasdangithubio&amp;callback=_carbonads_go"></script>
</head>


</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top ">
    <div class="container-fluid">
      <a class="navbar-toggler pull-right" onclick="myFunction(); changeContentWrapperSize();"><span id="toggle" style=" font-size: 25px; margin-top:13px; color:white;" class="glyphicon glyphicon-menu-hamburger"></a>
      <a class="navbar-brand font-color" style="margin-left:50px" href="#">S.M.P</a>
    </div>
  </nav>
  <div id="mySidebar" class="sidebar">

    <a class="border font-color" href="{{ url('admin_accounts_index') }}">Cuentas<span class="glyphicon glyphicon-user right-aling-glyphicon-cuentas"></a>

    <a class="border font-color">Trabajos<span class="glyphicon glyphicon-folder-open right-aling-glyphicon-trabajos"></a>

	<a class="border font-color" href="{{ route('clients') }}">Clientes<span class="glyphicon glyphicon-comment right-aling-glyphicon-clientes"></a>

    <a class="border font-color" href="{{ url('estados') }}">Estados<span class="glyphicon glyphicon glyphicon-tags right-aling-glyphicon-estados"></a>

	<a class="border font-color" href="{{ url('visitas') }}">Visitas<span class="glyphicon glyphicon-home right-aling-glyphicon-visitas"></a>

    <a class="border font-color" href="{{ url('contrasennaAdmin') }}">Contraseña<span class="glyphicon glyphicon-lock right-aling-glyphicon-contrasenna"></a>


    <a class="border font-color" href="{{ url('/logout') }}">Salir<span class="glyphicon glyphicon-log-out right-aling-glyphicon-logout"></a>
    <br>
    <br>
	
    <div class="logo_prisma_sidebar"><img src="{{asset('Imagenes/prisma_logo.png')}}"style="width:120px; height:120px;"></div>  			
</div>

<div id="main" class="page-content-wrapper" style="position: absolute;">
<div class="container-fluid">
                <div class="row">
                  @if(session('error'))
                    <div class="alert alert-danger alert-dismissible" style="text-align: center; padding:20px;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      {{@session('error')}}
                    </div>
                  @endif
                  @if(session('success'))
                    <div class="alert alert-success alert-dismissible" style="text-align: center; margin-top:10px; 
                    margin-left:10px; margin-right:10px;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      {{@session('success')}}
                    </div>
                  @endif
                  @if(session('info'))
                    <div class="alert alert-info alert-dismissible" style="text-align: center;" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      {{@session('info')}}
                    </div>
                  @endif
    @yield('contenido_Admin')	
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success alert-dismissible" style="text-align: center;" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{@session('success')}}
        </div>
        @endif
        @if(session('info'))
        <div class="alert alert-info alert-dismissible" style="text-align: center;" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{@session('info')}}
        </div>
        @endif
        @yield('contenido_Admin')
      </div>
    </div>
  </div>
</body>

</html>