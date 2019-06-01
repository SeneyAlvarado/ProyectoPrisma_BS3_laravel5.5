@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Work / Edit #{{$work->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('works.update', $work->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="priority-field">Priority</label>
	--priority--
</div> <div class="form-group">
	<label for="advance_payment-field">Advance_payment</label>
	--advance_payment--
</div> <div class="form-group">
	<label for="approximate_date-field">Approximate_date</label>
	--approximate_date--
</div> <div class="form-group">
	<label for="designer_date-field">Designer_date</label>
	--designer_date--
</div> <div class="form-group">
	<label for="print_date-field">Print_date</label>
	--print_date--
</div> <div class="form-group">
	<label for="post_production_date-field">Post_production_date</label>
	--post_production_date--
</div> <div class="form-group">
	<label for="drying_hours-field">Drying_hours</label>
	--drying_hours--
</div> <div class="form-group">
	<label for="observation-field">Observation</label>
	<input class="form-control" type="text" name="observation" id="observation-field" value="{{ old('observation', $work->observation ) }}" />
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
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('works.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection