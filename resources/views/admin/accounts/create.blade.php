@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin.js')}}"></script>
<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel" >
       <p class="title-panel" style="font-size:20px;">Crear cuentas</p>
   </div>
    <div class="panel-body">
        <section class="">
        <div class="">
                    <form method = 'POST' action='{{ url("createUser") }}'>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                        <label for="name" ><strong>Nombre</strong></label> 
                        <input id="name" placeholder="Nombre" class="form-control" name = "name" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo"> 
                        </div>
                        <div class="col-md-4 " style="margin-top:10px;">
                        <label for="name" ><strong>Primer apellido</strong></label> 
                        <input id="lastname"placeholder="Primer Apellido" class="form-control" name = "lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>            
                        </div>
                        <div class="col-md-8 col-md-offset-2" style="margin-top:10px;">
                        <label for="name" ><strong>Segundo apellido</strong></label> 
                        <input id="second_lastname" placeholder="Segundo Apellido" class="form-control" name = "second_lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>    
                        </div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                        <label for="email" ><strong>Correo electrónico</strong></label> 
                        <input id="email" placeholder="Correo electrónico" class="form-control" name = "email" type = 'email' required>
                        </div>
                        <div class="col-md-4 " style="margin-top:10px;">
                        <label for="user_name" ><strong>Nombre de usuario</strong></label> 
                        <input id="user_name" placeholder="Nombre de usuario" class="form-control" name = "user_name" type = 'text' required>
                        </div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                        <label for="branch" ><strong>Sucursal</strong></label> 
                        <select id="dropBranch" name="dropBranch" class="form-control"></select>
                        </div>
                        <div class="col-md-4" style="margin-top:10px;">
                        <label for="name" ><strong>Puesto</strong></label> 
                        <select class="form-control" name="dropRol" id="dropRol">
                            <option value="" disabled selected>Seleccione un puesto</option>
                            <option id="1" name="1" value="1">Administrador</option>
                            <option >Diseñador</option>
                            <option >Jefatura de diseño</option>
                            <option >Recepcionista</option>
                            <option >Impresión</option>
                            <option >Post-Producción</option>
                        </select>
                        </div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                        <label for="name" ><strong>Contraseña</strong></label> 
                                <input  placeholder="Contraseña" id="password" type="password" class="form-control" name="password" required minlength="1">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-4" style="margin-top:10px;">
                        <label for="name" ><strong>Confirmar contraseña</strong></label> 
                                <input placeholder="Confirmar contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="1">
                            </div>
                            <br>
                            <div class="col-md-8 col-md-offset-2" style="margin-top:20px;">
                                <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                                <a  class="btn btn btn-success">Regresar</a>
                            </div>  
                        <!--<a style="margin-top: 5px;" href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>-->
                    </form>
            </div>
        </section>
    </div>
</div>
</div>

@endsection