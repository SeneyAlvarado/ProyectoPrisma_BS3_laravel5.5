@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('/js/State_user_type/check_state_user_type_drop.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/css/botonesCrear.css')}}">
<div style="padding:10px;">
        <div class="card">
            <h5 class="card-header" style="text-align:center">Acceso a Trabajos</h5>
            <div class="card-body">
            <div class="container-fluid">
                <div class="">
                    <form method='POST' action='{{ url("state_user_types.update", $state_user_types->id) }}'>
                        <input type='hidden' name='_token' value='{{Session::token()}}'>

                        <div class="row justify-content-center">
                            <div class="col-md-4" style="margin-top:15px;">
                                <label for="rol"><strong>Puesto</strong></label>
                                <select class="form-control" name="dropRol" id="dropRol" disabled>
                                    <option>{{$state_user_types->user_type_name}}</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="margin-top:15px;">
                                <label for="state"><strong>Estado</strong></label>
                                <select id="dropState" name="dropState" class="form-control" disabled>
                                    <option>{{$state_user_types->state_name}}</option>
                                </select>
                                    
                            </div>
                        </div>
                        
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-md-offset-3" style="margin-top:10px; margin-left: 38%">
                                <label for="type" style="margin-left: 8%"><strong>Notificaciones al usuario</strong> 
                                    <span class="glyphicon glyphicon-question-sign fa-fw mr-3" data-toggle="tooltip" data-placement="top" 
                                   title="Notifica a los usuarios con el puesto seleccionado 
cuando hay un trabajo con el estado seleccionado"><!--Do not move this text, it's aligned-->
                                    </span>
                                </label> 
                                <br>
                                @if($state_user_types->state_notification == 1)
                                <input type="radio" style="margin-left: 10%; transform: scale(1.3);" name="notification" value="0" > &nbsp;&nbsp; Desactivadas <br>
                                <input type="radio" style="margin-left: 10%; transform: scale(1.3);" name="notification" value="1" checked>&nbsp;&nbsp; Activadas <br><br>
                                @endif
                                @if($state_user_types->state_notification == 0)
                                <input type="radio" style="margin-left: 10%; transform: scale(1.3);" name="notification" value="0" checked> &nbsp;&nbsp; Desactivadas <br>
                                <input type="radio" style="margin-left: 10%; transform: scale(1.3);" name="notification" value="1" >&nbsp;&nbsp; Activadas <br><br>
                                @endif
                            </div>
                        </div>

                        <br>
                        <div class="row justify-content-center">
                        <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                            <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                        <div class="col-md-4" style="margin-top:5px; ">
                            <a class="btn btn btn-block" href="{{ route('state_user_types') }}">Cancelar</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection