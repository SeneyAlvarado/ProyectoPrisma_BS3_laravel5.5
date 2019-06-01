@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Client / Edit #{{$client->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="id-field">Id</label>
	--id--
</div> <div class="form-group">
	<label for="type-field">Type</label>
	--type--
</div> <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $client->name ) }}" />
</div> <div class="form-group">
	<label for="address-field">Address</label>
	<input class="form-control" type="text" name="address" id="address-field" value="{{ old('address', $client->address ) }}" />
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div> <div class="form-group">
	<label for="identification-field">Identification</label>
	<input class="form-control" type="text" name="identification" id="identification-field" value="{{ old('identification', $client->identification ) }}" />
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('clients.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection