<!DOCTYPE html>
<html class="h-100">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sistema de monitoreo de procesos</title>
	@yield('encabezado')
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/menus.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/base.css" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/CK7DC5QN.json?segment=placement:eonasdangithubio&amp;callback=_carbonads_go"></script></head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body class="bg-color h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-around h-100 align-items-center">
                <div class="col-sm-5">
                    <br>
                    <img src="/Imagenes/Prisma.png" heigth="100px" width="100px" class="img-responsive center-block"/>
                    <br>
                    <br>
                    <form>
                            <div class="form-group">
                              <label >Nombre de usuario</label>
                              <input type="email" class="form-control" id="username" placeholder="Digite su nombre de usuario">
                            </div>
                            <div class="form-group">
                              <label>Contraseña</label>
                              <input type="password" class="form-control" id="password" placeholder="Contraseña">
                            </div>
                            <br>
                            <button type="button" class="button">Ingresar</button>
                            <div>
                                <br>
                                <a href="{{ url('/prueba') }}">Recuperar contraseña</a>
                                <br>
                            </div>
                          </form>
                </div>
            </div>
        </div>
    <footer class="main-footer" style="height:20px; opacity:0.6">
  	<div class="text-center main-footer"  style="height:15px;">
        <p style="font-size:1em; color:#96183a;">
            <strong>Grupo Prisma, <?php use Carbon\Carbon;echo Carbon::now()->year; ?></strong></p>
  	</div>
	</footer>

	<script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
</body>

</html>