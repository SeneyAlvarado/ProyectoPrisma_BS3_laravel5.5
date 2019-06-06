@extends('masterAdmin')

@section('contenido_Admin')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('states.update', $state->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $state->name ) }}" />
</div> <div class="form-group">
	<label for="description-field">Description</label>
	<input class="form-control" type="text" name="description" id="description-field" value="{{ old('description', $state->description ) }}" />
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('states.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection