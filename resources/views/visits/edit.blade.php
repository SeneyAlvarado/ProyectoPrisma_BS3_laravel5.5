@extends('masterPrueba3')

@section('contenido_Admin')
	@include('error')
	
	<script src="{{asset('js/createClientsRadio.js')}}"></script>
<script src="{{asset('js/requiredFields.js')}}"></script>

	<div style="padding:10px;">
		<div class="panel panel-primary border-panel">
			<div class="panel-heading  border-header bg-color-panel" >
					<p class="title-panel" style="font-size:20px;">Detalles visita</p>
			</div>
			<div class="panel-body">
				<section class="">
					<div class="">
            <form action="{{ url('actualizarVisita', $visit->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="client_name-field">Client_name</label>
	<input class="form-control" type="text" name="client_name" id="client_name-field" value="{{ old('client_name', $visit->client_name ) }}" />
</div> <div class="form-group">
	<label for="date-field">Date</label>
	--date--
</div> <div class="form-group">
	<label for="phone-field">Phone</label>
	--phone--
</div> <div class="form-group">
	<label for="email-field">Email</label>
	<input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $visit->email ) }}" />
</div> <div class="form-group">
	<label for="details-field">Details</label>
	<input class="form-control" type="text" name="details" id="details-field" value="{{ old('details', $visit->details ) }}" />
</div> <div class="form-group">
	<label for="visitor_id-field">Visitor_id</label>
	--visitor_id--
</div> <div class="form-group">
	<label for="visitor_id-field">Visitor_id</label>
	--visitor_id--
</div> <div class="form-group">
	<label for="recepcionist_id-field">Recepcionist_id</label>
	--recepcionist_id--
</div> <div class="form-group">
	<label for="recepcionist_id-field">Recepcionist_id</label>
	--recepcionist_id--
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('visits.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection