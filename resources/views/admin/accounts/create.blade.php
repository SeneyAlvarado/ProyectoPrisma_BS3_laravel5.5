@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin.js')}}"></script>
<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel" >
       <p class="title-panel" style="font-size:20px;">Crear cuentas</p>
   </div>
    <div class="panel-body">
        <section class="">
        <div class="content-c w3-container">    
            <div class=" center">
                
                    <form method = 'POST' action = ''>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <div class="col-md-4 ">
                        <input id="name" placeholder="Nombre" class="form-control" name = "nombre" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo"> 
                        </div>
                        <div class="col-md-4 ">
                        <input id="lastname"placeholder="Primer Apellido" class="form-control" name = "primer_apellido" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo" required>            
                        </div>
                        <div class="col-md-4 ">
                        <input id="second_lastname" placeholder="Segundo Apellido" class="form-control" name = "segundo_apellido" type="text" pattern="[a-zA-Z]{2,48}" title="No se permiten números en este campo" required>    
                        </div>
                        <div class="col-md-4 " style="margin-top:20px;">
                        <input id="email" placeholder="Correo electrónico" class="form-control" name = "email" type = 'text' required>
                        </div>
                        <div class="col-md-4 " style="margin-top:20px;">
                        <input id="user_name" placeholder="Nombre de usuario" class="form-control" name = "user_name" type = 'text' required>
                        </div>
                        <div class="col-md-4 " style="margin-top:20px;">
                        <select id="dropBranch" class="form-control"></select>
                        </div>
                        <button  style="margin-top: 5px;" class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i>Crear cuenta</button>
                        <!--<a style="margin-top: 5px;" href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>-->
                    </form>
               
        </div>
        </div>
        </section>
    </div>
</div>

@endsection