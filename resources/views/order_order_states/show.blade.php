@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Order_order_state / Show #{{$order_order_state->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('order_order_states.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('order_order_states.edit', $order_order_state->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Date</label>
<p>
	{{ $order_order_state->date }}
</p> <label>Order_states_id</label>
<p>
	{{ $order_order_state->order_states_id }}
</p> <label>Order_states_id</label>
<p>
	{{ $order_order_state->order_states_id }}
</p> <label>Order_id</label>
<p>
	{{ $order_order_state->order_id }}
</p> <label>Order_id</label>
<p>
	{{ $order_order_state->order_id }}
</p> <label>User_id</label>
<p>
	{{ $order_order_state->user_id }}
</p> <label>User_id</label>
<p>
	{{ $order_order_state->user_id }}
</p>

        </div>

    </div>
@endsection
