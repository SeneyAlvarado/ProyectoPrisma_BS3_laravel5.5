@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Order / Show #{{$order->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('orders.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('orders.edit', $order->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Entry_date</label>
<p>
	{{ $order->entry_date }}
</p> <label>Approximate_date</label>
<p>
	{{ $order->approximate_date }}
</p> <label>Quotation_number</label>
<p>
	{{ $order->quotation_number }}
</p> <label>Client_owner</label>
<p>
	{{ $order->client_owner }}
</p> <label>Client_owner</label>
<p>
	{{ $order->client_owner }}
</p> <label>Client_contact</label>
<p>
	{{ $order->client_contact }}
</p> <label>Client_contact</label>
<p>
	{{ $order->client_contact }}
</p> <label>
State_id</label>
<p>
	{{ $order->
state_id }}
</p> <label>
State_id</label>
<p>
	{{ $order->
state_id }}
</p> <label>Branch_id</label>
<p>
	{{ $order->branch_id }}
</p> <label>Branch_id</label>
<p>
	{{ $order->branch_id }}
</p> <label>Active_flag</label>
<p>
	{{ $order->active_flag }}
</p>

        </div>

    </div>
@endsection
