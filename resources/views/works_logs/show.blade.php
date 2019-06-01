@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Works_log / Show #{{$works_log->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('works_logs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('works_logs.edit', $works_log->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Date</label>
<p>
	{{ $works_log->date }}
</p> <label>Attribute</label>
<p>
	{{ $works_log->attribute }}
</p> <label>Value</label>
<p>
	{{ $works_log->value }}
</p> <label>Work_id</label>
<p>
	{{ $works_log->work_id }}
</p> <label>Work_id</label>
<p>
	{{ $works_log->work_id }}
</p> <label>User_id</label>
<p>
	{{ $works_log->user_id }}
</p> <label>User_id</label>
<p>
	{{ $works_log->user_id }}
</p>

        </div>

    </div>
@endsection
