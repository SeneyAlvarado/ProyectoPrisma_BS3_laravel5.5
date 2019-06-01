@extends('layout')
@section('header')
    <div class="page-header">
        <h1>User_type / Show #{{$user_type->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('user_types.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('user_types.edit', $user_type->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $user_type->name }}
</p> <label>Description</label>
<p>
	{{ $user_type->description }}
</p> <label>Active_flag</label>
<p>
	{{ $user_type->active_flag }}
</p>

        </div>

    </div>
@endsection
