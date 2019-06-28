@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Order_order_state
            <a class="btn btn-success pull-right" href="{{ route('order_order_states.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($order_order_states->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date</th> <th>Order_states_id</th> <th>Order_states_id</th> <th>Order_id</th> <th>Order_id</th> <th>User_id</th> <th>User_id</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order_order_states as $order_order_state)
                            <tr>
                                <td class="text-center"><strong>{{$order_order_state->id}}</strong></td>

                                <td>{{$order_order_state->date}}</td> <td>{{$order_order_state->order_states_id}}</td> <td>{{$order_order_state->order_states_id}}</td> <td>{{$order_order_state->order_id}}</td> <td>{{$order_order_state->order_id}}</td> <td>{{$order_order_state->user_id}}</td> <td>{{$order_order_state->user_id}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('order_order_states.show', $order_order_state->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('order_order_states.edit', $order_order_state->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('order_order_states.destroy', $order_order_state->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $order_order_states->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection