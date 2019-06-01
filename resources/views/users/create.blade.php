@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> User / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('users.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="" />
</div> <div class="form-group">
	<label for="lastname-field">Lastname</label>
	<input class="form-control" type="text" name="lastname" id="lastname-field" value="" />
</div> <div class="form-group">
	<label for="second_lastname-field">Second_lastname</label>
	<input class="form-control" type="text" name="second_lastname" id="second_lastname-field" value="" />
</div> <div class="form-group">
	<label for="username-field">Username</label>
	<input class="form-control" type="text" name="username" id="username-field" value="" />
</div> <div class="form-group">
	<label for="password-field">Password</label>
	<input class="form-control" type="text" name="password" id="password-field" value="" />
</div> <div class="form-group">
	<label for="email-field">Email</label>
	<input class="form-control" type="text" name="email" id="email-field" value="" />
</div> <div class="form-group">
	<label for="branch_id-field">Branch_id</label>
	--branch_id--
</div> <div class="form-group">
	<label for="branch_id-field">Branch_id</label>
	--branch_id--
</div> <div class="form-group">
	<label for="type_id-field">Type_id</label>
	--type_id--
</div> <div class="form-group">
	<label for="type_id-field">Type_id</label>
	--type_id--
</div> <div class="form-group">
	<label for="active_flag-field">Active_flag</label>
	--active_flag--
</div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('users.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection