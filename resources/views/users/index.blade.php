@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> User
            <a class="btn btn-success pull-right" href="{{ route('users.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($users->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th> <th>Lastname</th> <th>Second_lastname</th> <th>Username</th> <th>Password</th> <th>Email</th> <th>Branch_id</th> <th>Branch_id</th> <th>Type_id</th> <th>Type_id</th> <th>Active_flag</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center"><strong>{{$user->id}}</strong></td>

                                <td>{{$user->name}}</td> <td>{{$user->lastname}}</td> <td>{{$user->second_lastname}}</td> <td>{{$user->username}}</td> <td>{{$user->password}}</td> <td>{{$user->email}}</td> <td>{{$user->branch_id}}</td> <td>{{$user->branch_id}}</td> <td>{{$user->type_id}}</td> <td>{{$user->type_id}}</td> <td>{{$user->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('users.show', $user->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('users.edit', $user->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $users->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection