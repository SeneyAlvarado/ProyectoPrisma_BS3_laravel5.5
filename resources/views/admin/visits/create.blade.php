@extends('masterAdmin')
@section('contenido_Admin')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<script src="{{asset('js/load_branches_admin.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Visitas</h5>
        <div class="card-body">
            <div class="container-fluid">
                <div class="">
					<form action="{{ url('guardarVisita') }}" method="POST">
						<input type="hidden" name="_token" value='{{Session::token()}}'>
						<div class="row justify-content-center">
							<div class="col-md-5 col-md-offset-2" style="margin-top:10px;">
								<label for="client_name-field"><strong>Nombre cliente</strong></label>
								<input class="form-control" type="text" name="client_name" id="client_name-field" value="" />
							</div>
							<div class="col-md-5" style="margin-top:10px;">
								<label for="date-field"><strong>Fecha</strong></label>
								<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
									<input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
									<div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
										<div class="input-group-text"><span class="glyphicon glyphicon-calendar"></span></div>
									</div>
								</div>
								<script type="text/javascript">
									$(function () {
										$('#datetimepicker4').datetimepicker({
											format: 'L',
											defaultDate: new Date()
										});
									});
								</script>

							</div>
							<div class="col-md-5 col-md-offset-2" style="margin-top:15px;">
								<label for="phone-field"><strong>Teléfono</strong></label>
								<input class="form-control" type="text" name="phone" id="phone-field" value="" />
							</div>
							<div class="col-md-5 " style="margin-top:15px;">
								<label for="email-field"><strong>Correo electrónico</strong></label>
								<input class="form-control" type="text" name="email" id="email-field" value="" />
							</div>
							<div class="col-md-10 col-md-offset-2" style="margin-top:15px;">
								<label for="details-field"><strong>Detalles</strong></label>
								<textarea class="form-control" type="text" name="details" id="details-field" value="" rows="5" style="resize: none;"></textarea>
							</div>
						</div>
						<br>
						<div class="row justify-content-center">
							<div class="col-md-5 col-md-offset-2" style="margin-top:5px;  ">
								<button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
							</div>
							<div class="col-md-5" style="margin-top:5px; ">
								<a class="btn btn btn-block" href="{{ url('visitas') }}">Cancelar</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
@endsection