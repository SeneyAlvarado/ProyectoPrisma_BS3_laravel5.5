@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Work / Show #{{$work->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('works.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('works.edit', $work->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Priority</label>
<p>
	{{ $work->priority }}
</p> <label>Advance_payment</label>
<p>
	{{ $work->advance_payment }}
</p> <label>Approximate_date</label>
<p>
	{{ $work->approximate_date }}
</p> <label>Designer_date</label>
<p>
	{{ $work->designer_date }}
</p> <label>Print_date</label>
<p>
	{{ $work->print_date }}
</p> <label>Post_production_date</label>
<p>
	{{ $work->post_production_date }}
</p> <label>Drying_hours</label>
<p>
	{{ $work->drying_hours }}
</p> <label>Observation</label>
<p>
	{{ $work->observation }}
</p> <label>Order_id</label>
<p>
	{{ $work->order_id }}
</p> <label>Order_id</label>
<p>
	{{ $work->order_id }}
</p> <label>User_id</label>
<p>
	{{ $work->user_id }}
</p> <label>User_id</label>
<p>
	{{ $work->user_id }}
</p> <label>Active_flag</label>
<p>
	{{ $work->active_flag }}
</p>

        </div>

    </div>
@endsection
