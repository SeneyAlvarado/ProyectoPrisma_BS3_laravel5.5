<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sistema de Monitoreo de Procesos - Grupo Prisma</title>
	<!-- Bootstrap core CSS 
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/master-root.css')}}">
    <link rel="stylesheet" href="{{asset('css/glyphicons.css')}}">

    <!--resizes table so the content won´t go down -->
    <link rel="stylesheet" href="{{asset('css/table.css')}}">

    <!-- align added button to Jquery datatable-->
    <link rel="stylesheet" href="{{asset('css/custom-button-datatable.css')}}">

    <!--<script src="{{asset('js/master-root.js')}}"></script>-->
    <script src="{{asset('js/menus_dinamicos.js')}}"></script>
	<script src="{{asset('js/app.min.js')}}"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>
<nav class="navbar nav-color navbar-expand-md navbar-dark bg-primary border border-left-0 border-top-0 border-right-0 border-light">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav">
  <li class="nav-item a active">
        <button class="btn btn-default style-return-button" onclick="history.back()"><span class="glyphicon glyphicon-menu-left"></span></button>
      </li>
  </ul>
  <a class="navbar-brand" href="#">
    <img src="{{asset('Imagenes/logo.png')}}" width="35" height="35" class="d-inline-block align-top"></div>  
    <span class="">Grupo Prisma</span>
  </a>


</nav><!-- NavBar END -->
<div class="container-fluid">
<div style="padding-top:3%;" class="col-md-6 offset-md-3">
        <div class="card ">
            <h5 class="card-header" style="text-align:center">Reestablecer contraseña</h5>
                <div class="card-body">
                    <div class="container-fluid">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="row justify-content-center">
                        <div class="col-md-8 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div>
                                <label for="email" class="control-label" style="font-weight: bold;" >Correo Electrónico</label>
                            </div>
                            <div style="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block" style="background-color:#96183a;
                                border:none;
                                color: white !important;">
                                    Reestablecer contraseña
                                </button>
                        </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
