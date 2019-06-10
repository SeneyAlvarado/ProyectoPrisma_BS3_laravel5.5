@extends('masterPrueba3')
@section('contenido_Admin')
<script src="{{asset('js/createClientsRadio.js')}}"></script>
<script src="{{asset('js/requiredFields.js')}}"></script>
<script src="{{asset('js/patternFields.js')}}"></script>

<div class="panel panel-primary border-panel">
        <div class="panel-heading  border-header bg-color-panel" >
                <p class="title-panel" style="font-size:20px;">Crear clientes</p>
            </div>
            <div class="panel-body">
                    <section class="">
                    <div class="">
                                <form method = 'POST' action='{{ url("createClient") }}'>
                                    <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                    <div align="right"><!-- align WORKS even if doesn´t compile-->
                                    <p style="font-size:12px; color:red;">* Requerido</p>
                                    </div>
                                    <div>   
                                            <div class="col-md-8 col-md-offset-3" style="margin-top:10px; margin-left: 38%">
                                                <label for="type" style="margin-left: 8%"><strong>Tipo de cliente</strong></label>  <br>
                                                <input type="radio" style="margin-left: 10%; transform: scale(1.3);"  name="type" value="1"> &nbsp;&nbsp; Físico  <br>
                                                <input type="radio" style="margin-left: 10%; transform: scale(1.3);" name="type" value="2">&nbsp;&nbsp; Jurídico <br><br>
                                            </div>                                      
                                    </div>
                                            
                                    <div>   
                                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                                            <label for="identification" ><strong>Cédula</strong><strong style="font-size: 15px"> </strong></label> 
                                                                    <!-- the strong whitespace is used to align it with the * required field -->
                                            <input id="identification" placeholder="Cédula" class="form-control" name = "identification" type="text">    
                                        </div>
                                        <div class="col-md-4 " style="margin-top:10px;">
                                            <label class="" for="name" ><strong style="margin-top: 75px">Nombre</strong><strong style="color:red; font-size: 15px">*</strong></label> 
                                            <input id="name" placeholder="Nombre" class="form-control" name = "name" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>    
                                        </div>
                                    </div>
                                    <div class="Box">
                                            <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                                                <label for="lastname" ><strong>Primer Apellido</strong><strong style="color:red; font-size: 15px">*</strong></label> 
                                                <input id="lastname" placeholder="Primer Apellido" class="form-control" name = "lastname" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required> 
                                            </div>
                                            <div class="col-md-4 " style="margin-top:10px;">
                                                <label for="second_lastname" ><strong>Segundo apellido</strong><strong style="color:red; font-size: 15px">*</strong></label> 
                                                <input id="second_lastname"placeholder="Segundo Apellido" class="form-control" name = "second_lastname" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>            
                                            </div>
                                        </div>
                                        <div>   
                                                <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                                                    <label for="number" ><strong>Teléfono</strong></label> 
                                                    <input id="number" placeholder="Teléfono" class="form-control" name = "number" type="tel" pattern="[0-9 \s]{4,15}" 
                                                    title="Por favor siga un formato de teléfono correcto" oninvalid="this.setCustomValidity('Por favor digite un teléfono válido')">    
                                                </div>
                                                <div class="col-md-4 " style="margin-top:10px;">
                                                        <label for="email" ><strong>Correo electrónico</strong><strong style="font-size: 15px"> </strong></label> 
                                                        <input id="email" placeholder="Correo electrónico" class="form-control" name = "email" type="email" 
                                                        title="Por favor siga un formato de correo electrónico correcto" oninvalid="this.setCustomValidity('Por favor digite un correo electrónico válido')">    
                                                </div>
                                            </div>
                                        <div>   
                                                <div class="col-md-8 col-md-offset-2" style="margin-top:10px;">
                                                    <label for="address" ><strong>Dirección</strong></label> 
                                                    <input id="address" placeholder="Dirección del cliente" class="form-control" name = "address" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ123456789 \s]{10,100}" title="Debe colocar al menos 10 caracteres" required>    
                                                </div>
                                            </div>
                                       
                                        <div>   
                                                <div class="col-md-4 col-md-offset-2" style="margin-top:20px;">
                                                        <button class = 'btn btn-success btn-block' type ='submit'><i class="fa fa-floppy-o"></i> Guardar</button></div>
                                                <div class="col-md-4 " style="margin-top:20px;">
                                                <a  class="btn btn btn-info btn-block" href="{{url()->previous()}}">Regresar</a>
                                                    </div>
                                            </div>
                                        
                                    <!--<a style="margin-top: 5px;" href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>-->
                                </form>
                        </div>
                    </section>
                </div>
    </div>
@endsection