@extends('masterAdmin')

@section('contenido_Admin')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Work
            <a class="btn btn-success pull-right" href="{{ route('works.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($works->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Priority</th> <th>Advance_payment</th> <th>Approximate_date</th> <th>Designer_date</th> <th>Print_date</th> <th>Post_production_date</th> <th>Drying_hours</th> <th>Observation</th> <th>Order_id</th> <th>Order_id</th> <th>User_id</th> <th>User_id</th> <th>Active_flag</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($works as $work)
                            <tr>
                                <td class="text-center"><strong>{{$work->id}}</strong></td>

                                <td>{{$work->priority}}</td> <td>{{$work->advance_payment}}</td> <td>{{$work->approximate_date}}</td> <td>{{$work->designer_date}}</td> <td>{{$work->print_date}}</td> <td>{{$work->post_production_date}}</td> <td>{{$work->drying_hours}}</td> <td>{{$work->observation}}</td> <td>{{$work->order_id}}</td> <td>{{$work->order_id}}</td> <td>{{$work->user_id}}</td> <td>{{$work->user_id}}</td> <td>{{$work->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('works.show', $work->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('works.edit', $work->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('works.destroy', $work->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $works->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection