@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Order_log / Show #{{$order_log->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('order_logs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('order_logs.edit', $order_log->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Date</label>
<p>
	{{ $order_log->date }}
</p> <label>Attribute</label>
<p>
	{{ $order_log->attribute }}
</p> <label>Value</label>
<p>
	{{ $order_log->value }}
</p> <label>Order_id</label>
<p>
	{{ $order_log->order_id }}
</p> <label>Order_id</label>
<p>
	{{ $order_log->order_id }}
</p> <label>User_id</label>
<p>
	{{ $order_log->user_id }}
</p> <label>User_id</label>
<p>
	{{ $order_log->user_id }}
</p>

        </div>

    </div>
@endsection
