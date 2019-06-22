@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin.js')}}"></script>
<script src="{{asset('js/check_inputs_create_user.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<div style="padding:10px;">
        <div class="card">
            <h5 class="card-header" style="text-align:center">Cuentas</h5>
            <div class="card-body">
            <div class="container-fluid">
                <div class="">
                    <form method='POST' action='{{ url("user.store") }}' onsubmit="return check_inputs_create_user(this)">
                        <input type='hidden' name='_token' value='{{Session::token()}}'>

                        <div class="row justify-content-center">
                            <div class="col-md-4 align-self-center" >
                                <label for="name"><strong>Nombre</strong></label>
                                <input id="name" placeholder="Nombre" class="form-control" name="name" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo">
                            </div>
                            <div class="col-md-4 align-self-center" >
                                <label for="lastname"><strong>Primer apellido</strong></label>
                                <input id="lastname" placeholder="Primer Apellido" class="form-control" name="lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 " style="margin-top:15px;">
                                <label for="name"><strong>Segundo apellido</strong></label>
                                <input id="second_lastname" placeholder="Segundo Apellido" class="form-control" name="second_lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>
                            </div>
                            <div class="col-md-4 " style="margin-top:15px;">
                                <label for="user_name"><strong>Nombre de usuario</strong></label>
                                <input id="user_name" placeholder="Nombre de usuario" class="form-control" name="user_name" type='text' required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 offset-md-5">
                            @if ($errors->has('user_name'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('user_name') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        <div class="row justify-content-center">
                        <div class="col-md-4 " style="margin-top:15px;">
                            <label for="email"><strong>Correo electrónico</strong></label>
                            <input id="email" placeholder="Correo electrónico" class="form-control" name="email" type='email' required>
                        </div>
                        <div class="col-md-4" style="margin-top:15px;">
                            <label for="branch"><strong>Sucursal</strong></label>
                            <select id="dropBranch" name="dropBranch" class="form-control"></select>
                        </div>
                        </div>
                        <div class="row justify-content-center">
                        <div class="col-md-4" style="margin-top:15px;">
                            <label for="rol"><strong>Puesto</strong></label>
                            <select class="form-control" name="dropRol" id="dropRol">
                            </select>
                        </div>
                        
                        <div class="col-md-4" style="margin-top:15px;">
                            <label for="name"><strong>Contraseña</strong></label>
                            <input placeholder="Contraseña" id="password" type="password" class="form-control" name="password" required minlength="1">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4 offset-md-2" style="margin-top:15px;">
                            <label for="name"><strong>Confirmar contraseña</strong></label>
                            <input placeholder="Confirmar contraseña" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required minlength="1">
                        </div>
                        </div>
                        <div class="row justify-content-center">
                        <div class="col-md-8 ">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                                <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                            <div class="col-md-4" style="margin-top:5px; ">
                                <a class="btn btn btn-block" href="{{ route('user.index') }}">Cancelar</a>
                            </div>
                        </div>
                        <!--<a style="margin-top: 5px;" href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection