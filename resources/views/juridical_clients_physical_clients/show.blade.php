@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Juridical_clients_physical_client / Show #{{$juridical_clients_physical_client->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('juridical_clients_physical_clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('juridical_clients_physical_clients.edit', $juridical_clients_physical_client->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Physical_client_id</label>
<p>
	{{ $juridical_clients_physical_client->physical_client_id }}
</p> <label>Physical_client_id</label>
<p>
	{{ $juridical_clients_physical_client->physical_client_id }}
</p> <label>Juridical_client_id</label>
<p>
	{{ $juridical_clients_physical_client->juridical_client_id }}
</p> <label>Juridical_client_id</label>
<p>
	{{ $juridical_clients_physical_client->juridical_client_id }}
</p>

        </div>

    </div>
@endsection
