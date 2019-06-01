@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Works_log
            <a class="btn btn-success pull-right" href="{{ route('works_logs.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($works_logs->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date</th> <th>Attribute</th> <th>Value</th> <th>Work_id</th> <th>Work_id</th> <th>User_id</th> <th>User_id</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($works_logs as $works_log)
                            <tr>
                                <td class="text-center"><strong>{{$works_log->id}}</strong></td>

                                <td>{{$works_log->date}}</td> <td>{{$works_log->attribute}}</td> <td>{{$works_log->value}}</td> <td>{{$works_log->work_id}}</td> <td>{{$works_log->work_id}}</td> <td>{{$works_log->user_id}}</td> <td>{{$works_log->user_id}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('works_logs.show', $works_log->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('works_logs.edit', $works_log->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('works_logs.destroy', $works_log->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $works_logs->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection