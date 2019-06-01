@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Detail / Edit #{{$detail->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('details.update', $detail->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="modification_date-field">Modification_date</label>
	--modification_date--
</div> <div class="form-group">
	<label for="detail-field">Detail</label>
	<input class="form-control" type="text" name="detail" id="detail-field" value="{{ old('detail', $detail->detail ) }}" />
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
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('details.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection