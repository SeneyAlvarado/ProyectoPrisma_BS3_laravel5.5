@extends('masterPrueba4')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin_edit.js')}}"></script>
<div style="padding:10px;">
<div class="panel panel-primary border-panel">
        <div class="panel-heading border-header bg-color-panel">
           <p style="text-align: center; font-size: 3vh;">Editar cuenta </p>
       </div>
       <div class="panel-body">
           <section class="">
           <form method = 'POST' action='{{ route("admin_update_accounts", $client->id) }}'>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'
                        <div align="right"><!-- align WORKS even if doesn´t compile-->
                            <p style="font-size:12px; color:red;">* Requerido</p>
                        </div>

                        <input type="hidden" name="_method" value="PUT">
                        <div>
                            <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                                <label for="identification" ><strong>Cédula</strong></label> 
                                <input id="identification" value="{{ old('identification', $client->identification) }}" class="form-control" name = "identification" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo"> 
                            </div>
                            <div class="col-md-4 " style="margin-top:10px;">
                                <label for="name" ><strong>Primer apellido</strong></label> 
                                <input id="lastname-field" class="form-control" value="{{ old('lastname', $client->lastname) }}" name = "lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>            
                            </div>
                        </div>
                        <div>   
                        <div class="col-md-8 col-md-offset-2" style="margin-top:10px;">
                            <label for="name" ><strong>Segundo apellido</strong></label> 
                            <input id="second_lastname-field" class="form-control" name = "second_lastname" value="{{ old('second_lastname', $client->second_lastname) }}" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>    
                        </div>
                    </div>
                        <div class="col-md-8 col-md-offset-2">
                        @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                            <input class="form-control" type="hidden" name="original_username" id="original_username" value="{{ old('username', $client->username) }}" />
                            <label for="user_name" ><strong>Nombre de usuario</strong></label> 
                            <input id="user_name-field" value="{{ old('username', $client->username) }}" class="form-control" name = "user_name" type = 'text' required>
                        </div>
                        <div class="col-md-4 " style="margin-top:10px;">
                        <input class="form-control" type="hidden" name="original_email" id="original_email" value="{{ old('email', $client->email) }}" />
                            <label for="email" ><strong>Correo electrónico</strong></label> 
                            <input id="email-field"  value="{{ old('email', $client->email) }}"class="form-control" name = "email" type = 'email' required>
                        </div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                            <label for="branch" ><strong>Sucursal</strong></label> 
                            <select id="dropBranch" name="dropBranch" class="form-control"></select>
                        </div>
                        <div class="col-md-4" style="margin-top:10px;">
                            <label for="name" ><strong>Puesto</strong></label> 
                            <select class="form-control" name="dropRol" id="dropRol">
                               
                            </select>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                
                        <br>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:20px;  ">
                            <button class = 'btn btn-success btn-block' type ='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                        <div class="col-md-4" style="margin-top:20px; ">  
                            <a class="btn btn btn-block btn-info" href="{{ route('admin_accounts_index') }}">Regresar</a>
                        </div>         
                    </form>
           </section>
        </div>
    </div>
</div>
@endsection