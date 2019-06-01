@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Product / Edit #{{$product->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $product->name ) }}" />
</div> <div class="form-group">
	<label for="description-field">Description</label>
	<input class="form-control" type="text" name="description" id="description-field" value="{{ old('description', $product->description ) }}" />
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div> <div class="form-group">
	<label for="branch_id-field">Branch_id</label>
	--branch_id--
</div> <div class="form-group">
	<label for="branch_id-field">Branch_id</label>
	--branch_id--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection