@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> User / Edit #{{$user->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name ) }}" />
</div> <div class="form-group">
	<label for="lastname-field">Lastname</label>
	<input class="form-control" type="text" name="lastname" id="lastname-field" value="{{ old('lastname', $user->lastname ) }}" />
</div> <div class="form-group">
	<label for="second_lastname-field">Second_lastname</label>
	<input class="form-control" type="text" name="second_lastname" id="second_lastname-field" value="{{ old('second_lastname', $user->second_lastname ) }}" />
</div> <div class="form-group">
	<label for="username-field">Username</label>
	<input class="form-control" type="text" name="username" id="username-field" value="{{ old('username', $user->username ) }}" />
</div> <div class="form-group">
	<label for="password-field">Password</label>
	<input class="form-control" type="text" name="password" id="password-field" value="{{ old('password', $user->password ) }}" />
</div> <div class="form-group">
	<label for="email-field">Email</label>
	<input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email ) }}" />
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('users.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection