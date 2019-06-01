@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Works_file
            <a class="btn btn-success pull-right" href="{{ route('works_files.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($works_files->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th> <th>Size</th> <th>Extension</th> <th>Order_id</th> <th>Order_id</th> <th>Work_id</th> <th>Work_id</th> <th>Active_flag</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($works_files as $works_file)
                            <tr>
                                <td class="text-center"><strong>{{$works_file->id}}</strong></td>

                                <td>{{$works_file->name}}</td> <td>{{$works_file->size}}</td> <td>{{$works_file->extension}}</td> <td>{{$works_file->order_id}}</td> <td>{{$works_file->order_id}}</td> <td>{{$works_file->work_id}}</td> <td>{{$works_file->work_id}}</td> <td>{{$works_file->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('works_files.show', $works_file->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('works_files.edit', $works_file->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('works_files.destroy', $works_file->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $works_files->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection