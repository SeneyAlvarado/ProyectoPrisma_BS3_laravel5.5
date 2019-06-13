@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin_edit.js')}}"></script>
<script >
branch({{$user->branch_id}})
rol({{$user->user_type_id}})
</script>
<div style="padding:10px;">
<div class="card">
            <h5 class="card-header" style="text-align:center">Cuentas</h5>
            <div class="card-body">
            <div class="container-fluid">
           <form method = 'POST' action='{{ route("admin_update_accounts", $user->id) }}'>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row justify-content-center">
                            <div class="col-md-4 " style="margin-top:10px;">
                                <label for="name" ><strong>Nombre</strong></label> 
                                <input id="name-field" value="{{ old('name', $user->name) }}" class="form-control" name = "name" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo"> 
                            </div>
                            <div class="col-md-4 " style="margin-top:10px;">
                                <label for="name" ><strong>Primer apellido</strong></label> 
                                <input id="lastname-field" class="form-control" value="{{ old('lastname', $user->lastname) }}" name = "lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>            
                            </div>
                        </div>
                      
                        <div class="row justify-content-center">   
                            <div class="col-md-4" style="margin-top:15px;">
                                <label for="name" ><strong>Segundo apellido</strong></label> 
                                <input id="second_lastname-field" class="form-control" name = "second_lastname" value="{{ old('second_lastname', $user->second_lastname) }}" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>    
                            </div>
                            <div class="col-md-4" style="margin-top:15px;">
                                <input class="form-control" type="hidden" name="original_username" id="original_username" value="{{ old('username', $user->username) }}" />
                                <label for="user_name" ><strong>Nombre de usuario</strong></label> 
                                <input id="user_name-field" value="{{ old('username', $user->username) }}" class="form-control" name = "user_name" type = 'text' required>
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
                            <input class="form-control" type="hidden" name="original_email" id="original_email" value="{{ old('email', $user->email) }}" />
                                <label for="email" ><strong>Correo electrónico</strong></label> 
                                <input id="email-field"  value="{{ old('email', $user->email) }}"class="form-control" name = "email" type = 'email' required>
                            </div>
                            <div class="col-md-4" style="margin-top:15px;">
                                <label for="branch" ><strong>Sucursal</strong></label> 
                                <select id="dropBranch" name="dropBranch" class="form-control"></select>
                            </div>
                        </div>
                        <div class="row "> 
                        <div class="col-md-4 offset-md-2" style="margin-top:15px;">
                                <label for="name" ><strong>Puesto</strong></label> 
                                <select class="form-control" name="dropRol" id="dropRol">
                                </select>
                            </div>
                        </div>

                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-md-offset-2" style="margin-top:20px;  ">
                                <button class = 'btn btn-success btn-block' type ='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                            <div class="col-md-4" style="margin-top:20px; ">  
                                <a class="btn btn btn-block btn-info" href="{{ route('admin_accounts_index') }}">Regresar</a>
                            </div>  
                        </div>           
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection