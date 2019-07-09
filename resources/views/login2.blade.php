<!DOCTYPE html>
<html lang="en">

<head>
	<title>Grupo Prisma</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="Imagenes/log.ico" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login2.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

</head>




<body class="login-block">

	<div class="row">
		<div class="col-md-8 login100-more image"style="background-image: url('Imagenes/print.jpg'); background-size: cover;">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                
		</div>
    </div>
    <div class="col-md-4 " style="height: 100% !important;">
        <div style="padding-top: 75px; padding-left: 50px; padding-right: 50px; padding-bottom: 50px; height: 100%;">
            <div style="text-align: center;">
                <h4 class="margin-bottom-title">Sistema de monitoreo de procesos</h4>
                <img class="margin-bottom-title" src="Imagenes/Prisma.png" style="width:100px;height:100px;align-items:center" />
            </div>
		    <form class="login100-form " method="POST" action="{{ url('login') }}">
			    @if(session()->has('success'))
					<div class="alert alert-success">
					    {{ session()->get('success') }}
					</div>
				@endif

				@if(session()->has('info'))
					<div class="alert alert-info">
						{{ session()->get('info') }}
				    </div>
				@endif

				@if(session()->has('error'))
					<div class="alert alert-danger">
						{{ session()->get('error') }}
					</div>
				@endif
				{{ csrf_field() }}
				<div class="form-group"
					data-validate="Username is required" style="height: 100%;">
                    <label style="position:relative;">Nombre de usuario</label>
                    <input class="form-control" type="text" id="username" name='username' required placeholder="Nombre de usuario">
                    <!--Return error message to user in case username is wrong-->
                    @if ($errors->has('username'))
                        <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                    @endif
				</div>

				<div class="form-group "
				    data-validate="Password is required" style="height: 100%;">
					<label>Contraseña</label>
					<input class="form-control" type="password" id="password" name="password" required placeholder="Contraseña">
					<!--Return error message to user in case username is wrong-->
					@if ($errors->has('password'))
						<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
					@endif
				</div>

				<div class="margin-bottom-title" style="height: 100%;">
					<div>
						<a href="{{ route('password.request')}}" class="txt1">¿Olvidó su contraseña?</a>
					</div>
				</div>

				<br>
				<button type="submit" class="login-btn btn btn-default btn-block" style=" margin-left: auto;margin-right: auto; float: none;">
					Ingresar
                </button>
                <br>
			</form>
        </div>
	</div>
</body>

<style>  


</style>