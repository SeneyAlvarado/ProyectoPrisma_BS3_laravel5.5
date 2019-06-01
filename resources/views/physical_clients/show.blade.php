@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Physical_client / Show #{{$physical_client->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('physical_clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('physical_clients.edit', $physical_client->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Lastname</label>
<p>
	{{ $physical_client->lastname }}
</p> <label>Second_lastname</label>
<p>
	{{ $physical_client->second_lastname }}
</p> <label>Client_id</label>
<p>
	{{ $physical_client->client_id }}
</p> <label>Client_id</label>
<p>
	{{ $physical_client->client_id }}
</p>

        </div>

    </div>
@endsection
