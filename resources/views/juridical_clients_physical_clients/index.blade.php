@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Juridical_clients_physical_client
            <a class="btn btn-success pull-right" href="{{ route('juridical_clients_physical_clients.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($juridical_clients_physical_clients->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Physical_client_id</th> <th>Physical_client_id</th> <th>Juridical_client_id</th> <th>Juridical_client_id</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($juridical_clients_physical_clients as $juridical_clients_physical_client)
                            <tr>
                                <td class="text-center"><strong>{{$juridical_clients_physical_client->id}}</strong></td>

                                <td>{{$juridical_clients_physical_client->physical_client_id}}</td> <td>{{$juridical_clients_physical_client->physical_client_id}}</td> <td>{{$juridical_clients_physical_client->juridical_client_id}}</td> <td>{{$juridical_clients_physical_client->juridical_client_id}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('juridical_clients_physical_clients.show', $juridical_clients_physical_client->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('juridical_clients_physical_clients.edit', $juridical_clients_physical_client->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('juridical_clients_physical_clients.destroy', $juridical_clients_physical_client->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $juridical_clients_physical_clients->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection