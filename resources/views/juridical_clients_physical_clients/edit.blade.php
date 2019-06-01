@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Juridical_clients_physical_client / Edit #{{$juridical_clients_physical_client->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('juridical_clients_physical_clients.update', $juridical_clients_physical_client->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="physical_client_id-field">Physical_client_id</label>
	--physical_client_id--
</div> <div class="form-group">
	<label for="physical_client_id-field">Physical_client_id</label>
	--physical_client_id--
</div> <div class="form-group">
	<label for="juridical_client_id-field">Juridical_client_id</label>
	--juridical_client_id--
</div> <div class="form-group">
	<label for="juridical_client_id-field">Juridical_client_id</label>
	--juridical_client_id--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('juridical_clients_physical_clients.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection