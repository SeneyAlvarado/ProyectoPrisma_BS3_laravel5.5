@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Client / Show #{{$client->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('clients.edit', $client->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Id</label>
<p>
	{{ $client->id }}
</p> <label>Type</label>
<p>
	{{ $client->type }}
</p> <label>Name</label>
<p>
	{{ $client->name }}
</p> <label>Address</label>
<p>
	{{ $client->address }}
</p> <label>Active_flag</label>
<p>
	{{ $client->active_flag }}
</p> <label>Identification</label>
<p>
	{{ $client->identification }}
</p>

        </div>

    </div>
@endsection
