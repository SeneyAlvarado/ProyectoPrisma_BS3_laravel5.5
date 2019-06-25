@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Order_state / Show #{{$order_state->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('order_states.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('order_states.edit', $order_state->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $order_state->name }}
</p> <label>Description</label>
<p>
	{{ $order_state->description }}
</p> <label>Active_flag</label>
<p>
	{{ $order_state->active_flag }}
</p>

        </div>

    </div>
@endsection
