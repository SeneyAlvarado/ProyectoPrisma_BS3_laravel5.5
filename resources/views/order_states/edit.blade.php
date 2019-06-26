@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Order_state / Edit #{{$order_state->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('order_states.update', $order_state->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $order_state->name ) }}" />
</div> <div class="form-group">
	<label for="description-field">Description</label>
	<input class="form-control" type="text" name="description" id="description-field" value="{{ old('description', $order_state->description ) }}" />
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('order_states.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection