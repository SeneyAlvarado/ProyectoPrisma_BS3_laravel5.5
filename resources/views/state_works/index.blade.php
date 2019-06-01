@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> State_work
            <a class="btn btn-success pull-right" href="{{ route('state_works.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($state_works->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date</th> <th>States_id</th> <th>States_id</th> <th>Work_id</th> <th>Work_id</th> <th>User_id</th> <th>User_id</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($state_works as $state_work)
                            <tr>
                                <td class="text-center"><strong>{{$state_work->id}}</strong></td>

                                <td>{{$state_work->date}}</td> <td>{{$state_work->states_id}}</td> <td>{{$state_work->states_id}}</td> <td>{{$state_work->work_id}}</td> <td>{{$state_work->work_id}}</td> <td>{{$state_work->user_id}}</td> <td>{{$state_work->user_id}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('state_works.show', $state_work->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('state_works.edit', $state_work->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('state_works.destroy', $state_work->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $state_works->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection