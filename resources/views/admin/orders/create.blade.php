<script src="{{asset('js/load_clients.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin.js')}}"></script>
<script src="{{asset('js/check_clients_branch_select.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<div style="padding:10px;">
        <div class="card">
            <h5 class="card-header" style="text-align:center">Órdenes</h5>
            <div class="card-body">
            <div class="container-fluid">
                <div class="">
                    <form method='POST' action='{{ route("orders.store") }}' onsubmit="return check_clients_branch_select(this)">
                        <input type='hidden' name='_token' value='{{Session::token()}}'>

                        <div class="row justify-content-center">
                            <div class="col-md-8 align-self-center" >
                                <label for="name"><strong>Cliente</strong></label>
                                <select multiple class="form-control" id="selectList" name="owner_client">
     
                                </select>  
                            </div>
    
                        </div>
                        <div class="row justify-content-center">

                            <div class="col-md-8 align-self-center" >
                                <label for="name"><strong>Cliente de contacto</strong></label>
                                <select multiple class="form-control" id="selectList_contact" name="contact_client">
     
                                </select>  
                            </div>
                        </div>

                        <div class="row justify-content-center" style="margin-top:20px;">
                            <div class="col-md-4 " >
                                <label for="name"><strong>Detalle de orden</strong></label>
                                <input id="order_detail" placeholder="Detalle de la órden" class="form-control" name="order_detail" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0-9 \s]{2,48}" title="" required>
                            </div>
                            <div class="col-md-4 ">
                                <label for="user_name"><strong>Número Cotización</strong></label>
                                <input id="user_name" placeholder="# Cotización" class="form-control" name="user_name" type='text' pattern="[0-9]*" title="No se permite ingresar letras en este campo" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 offset-md-5">
                            @if ($errors->has('delibery_date'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('delibery_date') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        <div class="row justify-content-center" style="margin-top:20px;">
                        <div class="col-md-4" >
								<label for="date-field"><strong>Fecha de entrega</strong></label>
								<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
									<input type="text"  name="date" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
									<div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
										<div class="input-group-text"><span class="glyphicon glyphicon-calendar"></span></div>
									</div>
								</div>
								<script type="text/javascript">
									$(function () {
										$('#datetimepicker4').datetimepicker({
											format: 'dd/mm/yyyy',
											defaultDate: new Date()
										});
									});
								</script>

							</div>
                            <div class="col-md-4">
                            <label for="branch"><strong>Sucursal</strong></label>
                            <select id="dropBranch" name="dropBranch" class="form-control"></select>
                        </div>
                        
                        </div>
                        <div class="row" style="margin-top:20px;">
                        <div class="col-md-3 offset-md-2" >
                            <label for="branch"><strong>¿Posee adelanto económico?</strong></label>
                            <div class="input-group " id="sexo">
                                <span class="radio">
                                <label>Sí</label>
                                <label>
                                    <input type="radio" value="1" class="radiobox" name="payment">
                                </label>
                               
                                    <label>
                                    <label style="margin-left:20px;">No</label>
                                        <input type="radio" value="2" class="radiobox" name="payment" checked>
                                    </label>
                                </span>
                            </div>
                        </div>
                        </div>
                     
                        <div class="row justify-content-center">
                        <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                            <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                        <div class="col-md-4" style="margin-top:5px; ">
                            <a class="btn btn btn-block" href="{{ route('products') }}">Cancelar</a>
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

<script>

$(document).ready(function(){
    listClients();
    listClients_contact();
})

$('#datepicker').datepicker({
  uiLibrary: 'bootstrap4',
  locale: 'es-es',
});
</script>

@endsection