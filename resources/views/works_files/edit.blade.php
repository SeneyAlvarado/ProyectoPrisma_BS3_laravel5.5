@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Works_file / Edit #{{$works_file->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('works_files.update', $works_file->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $works_file->name ) }}" />
</div> <div class="form-group">
	<label for="size-field">Size</label>
	--size--
</div> <div class="form-group">
	<label for="extension-field">Extension</label>
	<input class="form-control" type="text" name="extension" id="extension-field" value="{{ old('extension', $works_file->extension ) }}" />
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('works_files.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection