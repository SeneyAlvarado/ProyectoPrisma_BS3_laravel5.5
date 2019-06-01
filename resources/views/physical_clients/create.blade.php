@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Physical_client / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('physical_clients.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="lastname-field">Lastname</label>
	<input class="form-control" type="text" name="lastname" id="lastname-field" value="" />
</div> <div class="form-group">
	<label for="second_lastname-field">Second_lastname</label>
	<input class="form-control" type="text" name="second_lastname" id="second_lastname-field" value="" />
</div> <div class="form-group">
	<label for="client_id-field">Client_id</label>
	--client_id--
</div> <div class="form-group">
	<label for="client_id-field">Client_id</label>
	--client_id--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('physical_clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection