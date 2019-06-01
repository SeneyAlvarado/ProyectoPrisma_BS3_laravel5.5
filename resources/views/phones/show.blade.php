@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Phone / Show #{{$phone->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('phones.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('phones.edit', $phone->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Number</label>
<p>
	{{ $phone->number }}
</p> <label>Active_flag</label>
<p>
	{{ $phone->active_flag }}
</p> <label>Client_id</label>
<p>
	{{ $phone->client_id }}
</p> <label>Client_id</label>
<p>
	{{ $phone->client_id }}
</p>

        </div>

    </div>
@endsection
