<!DOCTYPE html>
<html lang="en">
<head>
	<title>Grupo Prisma</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/bootstrap.min.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/font-awesome.min.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/util.css')}}">


    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    


	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">


</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/Imagenes/bg-03.jpg);">
					<span class="login100-form-title-1">
						Ingresar
					</span>
				</div>

				<form class="login100-form " method="POST" action="{{ url('login') }}">
                {{ csrf_field() }}
					<div class="form-group wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Nombre de usuario</span>
						<input class="input100" type="text" id="username" name='username' placeholder="Nombre de usuario">
						<span class="focus-input100"></span>
					</div>

					<div class="form-group wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Contraseña</span>
						<input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div>
							<a href="#" class="txt1">
                            ¿Olvidó su contraseña?
							</a>
						</div>
					</div>

					<div class="" style="width:400px;  ">
						<button type="submit" class="login100-form-btn" style=" margin-left: auto;
    margin-right: auto;
    float: none;" >
							Ingresar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="{{asset('css/login/jquery-3.2.1.min.js"></script>
	<script src="{{asset('css/login/js/bootstrap.min.js"></script>


</body>
</html>