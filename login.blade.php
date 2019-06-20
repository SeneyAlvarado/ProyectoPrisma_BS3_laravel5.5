<!DOCTYPE html>
<html lang="en">

<head>
	<title>Grupo Prisma</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="{{asset('/css/login/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login/font-awesome.min.css')}}">

	<!--link rel="stylesheet" type="text/css" href="{{asset('/css/login/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/login/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login/util.css')}}"-->
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">


	<link rel="icon" type="image/png" href="/images/icons/favicon.ico" />



	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">


</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div style="padding-top: 75px;text-align: center; height:625px">
					<h3>Sistema de monitoreo de procesos</h3>
					<br>
					<img src="Imagenes/Prisma.png" style="width:80px;height:80px;align-items:center" />
					<form class="login100-form " method="POST" action="{{ url('login') }}">

						{{ csrf_field() }}
						<div class="form-group wrap-input100 validate-input m-b-26" data-validate="Username is required">
							<label>Nombre de usuario</label>
							<input class="form-control" type="text" id="username" name='username'>

						</div>

						<div class="form-group wrap-input100 validate-input m-b-18" data-validate="Password is required">
							<label>Contraseña</label>
							<input class="form-control" type="password" id="password" name="password">

						</div>

						<div class="flex-sb-m w-full p-b-30">
							<br>
							<div>
								<a href="{{ route('password.request')}}" class="txt1">
									¿Olvidó su contraseña?
								</a>
							</div>
						</div>

						<div class="" style="width:450px;  ">
							<br>
							<button type="submit" class="login100-form-btn" style=" margin-left: auto;
		margin-right: auto;
		float: none;">
								Ingresar
							</button>
						</div>
					</form>
				</div>
				<div class="login100-more" style="background-image: url('/Imagenes/print.jpg');">
				</div>
			</div>
		</div>
	</div>

	<style>
	</style>




	<script src="{{asset('css/login/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('/css/login/js/bootstrap.min.js')}}"></script>


</body>

</html>