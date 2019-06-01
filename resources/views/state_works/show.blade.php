@extends('layout')
@section('header')
    <div class="page-header">
        <h1>State_work / Show #{{$state_work->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('state_works.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('state_works.edit', $state_work->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Date</label>
<p>
	{{ $state_work->date }}
</p> <label>States_id</label>
<p>
	{{ $state_work->states_id }}
</p> <label>States_id</label>
<p>
	{{ $state_work->states_id }}
</p> <label>Work_id</label>
<p>
	{{ $state_work->work_id }}
</p> <label>Work_id</label>
<p>
	{{ $state_work->work_id }}
</p> <label>User_id</label>
<p>
	{{ $state_work->user_id }}
</p> <label>User_id</label>
<p>
	{{ $state_work->user_id }}
</p>

        </div>

    </div>
@endsection
