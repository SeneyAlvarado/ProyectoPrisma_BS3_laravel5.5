@extends('layout')
@section('header')
    <div class="page-header">
        <h1>State / Show #{{$state->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('states.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('states.edit', $state->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $state->name }}
</p> <label>Description</label>
<p>
	{{ $state->description }}
</p> <label>Active_flag</label>
<p>
	{{ $state->active_flag }}
</p>

        </div>

    </div>
@endsection
