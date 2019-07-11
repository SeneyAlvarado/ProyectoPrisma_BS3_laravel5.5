@extends('masterPrint')
@section('content_Print')
<script src="{{asset('/js/Users/load_branches_admin.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/css/botonesCrear.css')}}">
<div style="padding:10px;">
        <div class="card">
            <h5 class="card-header" style="text-align:center">Visitas</h5>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="">
            			<form action="{{ url('updateVisit', $visit->id) }}" method="POST">
                			<input type="hidden" name="_method" value="PUT">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row justify-content-center">
								<div class="col-md-5 col-md-offset-2" style="margin-top:10px;">
									<label for="client_name-field"><strong>Nombre cliente</strong></label>
									<input class="form-control" type="text" name="client_name" id="client_name-field" value="{{ old('client_name', $visit->client_name ) }}" required/>
								</div> 
								<div class="col-md-5" style="margin-top:10px;">
									<label for="date-field"><strong>Fecha</strong></label>
									<input class="form-control" type="text" name="date" id="date-field" value="{{ old('date', \Carbon\Carbon::parse($visit->date)->format('d/m/Y')) }}" disabled/>
								</div> 
								<div class="col-md-5 col-md-offset-2" style="margin-top:15px;">
									<label for="phone-field"><strong>Teléfono</strong></label>
									<input class="form-control" type="text" name="phone" id="phone-field" value="{{ old('phone', $visit->phone ) }}" />
								</div> 
								<div class="col-md-5 " style="margin-top:15px;">
									<label for="email-field"><strong>Correo electrónico</strong></label>
									<input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $visit->email ) }}" />
								</div> 
								<div class="col-md-10 col-md-offset-2" style="margin-top:15px;">
									<label for="details-field"><strong>Detalles</strong></label>
									<textarea class="form-control" type="text" name="details" id="details-field" value="" rows="5" style="resize: none;" required>{{ old('details', $visit->details ) }}</textarea>
								</div> 
							</div>
							<br>
                            <div class="row justify-content-center">
                                <div class="col-md-5 col-md-offset-2" style="margin-top:5px;  ">
                                    <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
								</div>
								<div class="col-md-5" style="margin-top:5px; ">
                                    <a class="btn btn btn-block" href="{{ url('visits') }}">Cancelar</a>
                                </div>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection