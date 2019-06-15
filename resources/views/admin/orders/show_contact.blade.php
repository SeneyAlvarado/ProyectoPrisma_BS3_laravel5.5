@extends('masterAdmin')
@section('contenido_Admin')
<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<script >
</script>
<div style="padding:10px;">
<div class="card">
            <h5 class="card-header" style="text-align:center">Contacto</h5>
            <div class="card-body">
            <div class="container-fluid">
           
            
            <?php 
            $clientName = $client->name;
            if($client->type == 1) {
                $clientName = $clientName . ' ' . $client->lastname . ' ' . $client->second_lastname;
            }

            $numeroTel = '';
            if($client->phones->count()) {
            foreach ($client->phones as $phone) {
                $numeroTel = $phone->number;
            }
            } else {
            $numeroTel = 'No tiene';
            }

            $clientEmail = '';
            if($client->emails->count()) {
            foreach ($client->emails as $email) {
                $clientEmail = $clientEmail . '  ' . $email->email;                           
            }
            } else {
            $clientEmail = 'No tiene';
            }

            $identification = $client->identification;
            if(empty($identification)){
            $identification = "-----";
            }
            ?>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-4 " style="margin-top:10px;">
                                <label for="name" ><strong>Nombre</strong></label> 
                                <input id="name-field" value="{{ old('name', $clientName) }}" class="form-control" name = "name" type="text" readonly> 
                            </div>
                            <div class="col-md-4 " style="margin-top:10px;">
                                <label for="name" ><strong>Cédula</strong></label> 
                                <input id="lastname-field" class="form-control" value="{{ old('identification', $client->identification) }}" name = "identification" type="text" readonly>            
                            </div>
                        </div>
                      
                        <div class="row justify-content-center">   
                            <div class="col-md-4" style="margin-top:15px;">
                                <label for="name" ><strong>Teléfono</strong></label> 
                                <input id="second_lastname-field" class="form-control" name = "phone" value="{{ old('phone', $numeroTel) }}" type="text" readonly>    
                            </div>
                            <div class="col-md-4" style="margin-top:15px;">
                                <input class="form-control" type="hidden" name="original_username" id="original_username" value="{{ old('email', $client->email) }}" />
                                <label for="user_name" ><strong>Correo</strong></label> 
                                <input id="user_name-field" value="{{ old('email', $clientEmail) }}" class="form-control" name = "email" type = 'text' readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-4" style="margin-top:20px; ">  
                                <a class="btn btn style-btn-success btn-block" href="">Editar</a>
                            </div> 
                            <div class="col-md-4" style="margin-top:20px; ">  
                                <a class="btn btn btn-block" href="{{ route('orders') }}">Regresar</a>
                            </div>  
                        </div>           
                  
                </div>
        </div>
    </div>
</div>
@endsection