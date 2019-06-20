@extends('layout')
@section('header')
    <div class="page-header">
        <h1>State_user_type / Show #{{$state_user_type->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('state_user_types.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('state_user_types.edit', $state_user_type->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>States_id</label>
<p>
	{{ $state_user_type->states_id }}
</p> <label>States_id</label>
<p>
	{{ $state_user_type->states_id }}
</p> <label>User_types_id</label>
<p>
	{{ $state_user_type->user_types_id }}
</p> <label>User_types_id</label>
<p>
	{{ $state_user_type->user_types_id }}
</p> <label>State_notification</label>
<p>
	{{ $state_user_type->state_notification }}
</p> <label>Active_flag</label>
<p>
	{{ $state_user_type->active_flag }}
</p>

        </div>

    </div>
@endsection
