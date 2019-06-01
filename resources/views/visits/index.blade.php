@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Visit
            <a class="btn btn-success pull-right" href="{{ route('visits.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($visits->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Client_name</th> <th>Date</th> <th>Phone</th> <th>Email</th> <th>Details</th> <th>Visitor_id</th> <th>Visitor_id</th> <th>Recepcionist_id</th> <th>Recepcionist_id</th> <th>Active_flag</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td class="text-center"><strong>{{$visit->id}}</strong></td>

                                <td>{{$visit->client_name}}</td> <td>{{$visit->date}}</td> <td>{{$visit->phone}}</td> <td>{{$visit->email}}</td> <td>{{$visit->details}}</td> <td>{{$visit->visitor_id}}</td> <td>{{$visit->visitor_id}}</td> <td>{{$visit->recepcionist_id}}</td> <td>{{$visit->recepcionist_id}}</td> <td>{{$visit->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('visits.show', $visit->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('visits.edit', $visit->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $visits->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection