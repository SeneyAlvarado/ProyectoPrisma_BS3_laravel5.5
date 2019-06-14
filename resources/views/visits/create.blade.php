@extends('masterAdmin')
@section('contenido_Admin')
@include('error')
<script src="{{asset('js/createClientsRadio.js')}}"></script>
<script src="{{asset('js/requiredFields.js')}}"></script>
<!--link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}"-->

<div style="padding:10px;">
	<div class="panel panel-primary border-panel">
		<div class="panel-heading  border-header bg-color-panel">
			<p class="title-panel" style="font-size:20px;">Crear visita</p>
		</div>
		<div class="panel-body">
			<section class="">
				<div class="">
					<form action="{{ url('guardarVisita') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
							<label for="client_name-field">Nombre cliente</label>
							<input class="form-control" type="text" name="client_name" id="client_name-field" value="" />
						</div>
						<div class="col-md-4" style="margin-top:10px;">
							<label for="date-field">Fecha</label>
							<!--input class="form-control" type="text" name="date" id="date-field" value=""-->
							<div class='input-group date' id='datetimepicker1'>
								<input type='text' class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker1').datetimepicker({
										format: 'DD/MM/YYYY',
										defaultDate: new Date()
									});
								});
							</script>

						</div>
						<div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
							<label for="phone-field">Teléfono</label>
							<input class="form-control" type="text" name="phone" id="phone-field" value="" />
						</div>
						<div class="col-md-4 " style="margin-top:10px;">
							<label for="email-field">Correo electrónico</label>
							<input class="form-control" type="text" name="email" id="email-field" value="" />
						</div>
						<div class="col-md-8 col-md-offset-2" style="margin-top:10px;">
							<label for="details-field">Detalles</label>
							<textarea class="form-control" type="text" name="details" id="details-field" value="" rows="5" style="resize: none;"></textarea>
						</div>
						<br>
						<div class="col-md-4 col-md-offset-2" style="margin-top:20px; width:70; height:100px;">
							<button class='btn btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button></div>
						<div class="col-md-4 " style="margin-top:20px;">
							<a class="btn btn btn-info btn-block" href="{{url('visitas')}}">Cancelar</a>
						</div>
				</div>
				</form>

		</div>
		</section>
	</div>
</div>
</div>
@endsection