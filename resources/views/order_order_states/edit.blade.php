@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Order_order_state / Edit #{{$order_order_state->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('order_order_states.update', $order_order_state->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="date-field">Date</label>
	--date--
</div> <div class="form-group">
	<label for="order_states_id-field">Order_states_id</label>
	--order_states_id--
</div> <div class="form-group">
	<label for="order_states_id-field">Order_states_id</label>
	--order_states_id--
</div> <div class="form-group">
	<label for="order_id-field">Order_id</label>
	--order_id--
</div> <div class="form-group">
	<label for="order_id-field">Order_id</label>
	--order_id--
</div> <div class="form-group">
	<label for="user_id-field">User_id</label>
	--user_id--
</div> <div class="form-group">
	<label for="user_id-field">User_id</label>
	--user_id--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('order_order_states.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection