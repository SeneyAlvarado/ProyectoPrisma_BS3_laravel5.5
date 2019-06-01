@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Works_file / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('works_files.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="" />
</div> <div class="form-group">
	<label for="size-field">Size</label>
	--size--
</div> <div class="form-group">
	<label for="extension-field">Extension</label>
	<input class="form-control" type="text" name="extension" id="extension-field" value="" />
</div> <div class="form-group">
	<label for="order_id-field">Order_id</label>
	--order_id--
</div> <div class="form-group">
	<label for="order_id-field">Order_id</label>
	--order_id--
</div> <div class="form-group">
	<label for="work_id-field">Work_id</label>
	--work_id--
</div> <div class="form-group">
	<label for="work_id-field">Work_id</label>
	--work_id--
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('works_files.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection