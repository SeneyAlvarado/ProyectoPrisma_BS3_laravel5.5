@extends('layout')
@section('header')
    <div class="page-header">
        <h1>User / Show #{{$user->id}}</h1>
    </div>
@endsection

@section('content')
    <div class="well well-sm">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('users.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            <div class="col-md-6">
                 <a class="btn btn-sm btn-warning pull-right" href="{{ route('users.edit', $user->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <label>Name</label>
<p>
	{{ $user->name }}
</p> <label>Lastname</label>
<p>
	{{ $user->lastname }}
</p> <label>Second_lastname</label>
<p>
	{{ $user->second_lastname }}
</p> <label>Username</label>
<p>
	{{ $user->username }}
</p> <label>Password</label>
<p>
	{{ $user->password }}
</p> <label>Email</label>
<p>
	{{ $user->email }}
</p> <label>Branch_id</label>
<p>
	{{ $user->branch_id }}
</p> <label>Branch_id</label>
<p>
	{{ $user->branch_id }}
</p> <label>Type_id</label>
<p>
	{{ $user->type_id }}
</p> <label>Type_id</label>
<p>
	{{ $user->type_id }}
</p> <label>Active_flag</label>
<p>
	{{ $user->active_flag }}
</p>

        </div>

    </div>
@endsection
