@extends('masterAdmin')

@section('contenido_Admin')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Order
            <a class="btn btn-success pull-right" href="{{ route('orders.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($orders->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Entry_date</th> <th>Approximate_date</th> <th>Quotation_number</th> <th>Client_owner</th> <th>Client_owner</th> <th>Client_contact</th> <th>Client_contact</th> <th>
State_id</th> <th>
State_id</th> <th>Branch_id</th> <th>Branch_id</th> <th>Active_flag</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center"><strong>{{$order->id}}</strong></td>

                                <td>{{$order->entry_date}}</td>
                                <td>{{$order->approximate_date}}</td> 
                                <td>{{$order->quotation_number}}</td> 
                                <td>{{$order->client_owner}}</td> 
                                <td>{{$order->client_owner}}</td> 
                                <td>{{$order->client_contact}}</td> 
                                <td>{{$order->client_contact}}</td> 
                                <td>{{$order->state_id}}</td> 
                                <td>{{$order->state_id}}</td> 
                                <td>{{$order->branch_id}}</td> 
                                <td>{{$order->branch_id}}</td> 
                                <td>{{$order->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('orders.show', $order->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('orders.edit', $order->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $orders->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection