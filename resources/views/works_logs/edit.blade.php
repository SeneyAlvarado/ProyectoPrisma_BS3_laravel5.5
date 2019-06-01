@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Works_log / Edit #{{$works_log->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('works_logs.update', $works_log->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="date-field">Date</label>
	--date--
</div> <div class="form-group">
	<label for="attribute-field">Attribute</label>
	<input class="form-control" type="text" name="attribute" id="attribute-field" value="{{ old('attribute', $works_log->attribute ) }}" />
</div> <div class="form-group">
	<label for="value-field">Value</label>
	<input class="form-control" type="text" name="value" id="value-field" value="{{ old('value', $works_log->value ) }}" />
</div> <div class="form-group">
	<label for="work_id-field">Work_id</label>
	--work_id--
</div> <div class="form-group">
	<label for="work_id-field">Work_id</label>
	--work_id--
</div> <div class="form-group">
	<label for="user_id-field">User_id</label>
	--user_id--
</div> <div class="form-group">
	<label for="user_id-field">User_id</label>
	--user_id--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('works_logs.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection