@extends('masterAdmin')

@section('header')
<div class="page-header clearfix">
    <h1>
        <i class="glyphicon glyphicon-align-justify"></i> Product
        <a class="btn btn-success pull-right" href="#"><i class="glyphicon glyphicon-plus"></i> Create</a>
    </h1>
</div>
@endsection

@section('content')
<!-- <div class="row">
    
        <div class="col-md-12"> -->
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel">
        <p class="title-panel" style="font-size:20px;">Materiales</p>
    </div>
    <div class="panel-body">
        <section class="">
            <div class="content-c w3-container mobile">
                <div>
                    <a class="btn btn-success style-btn-registry" href="{{ url('productoCreate') }} " style="margin-left: 15px; ">Registrar </a>

                </div>
            </div>

            <div class="panel-heading">
                <div class="">
                    <div class="">
                        @if($products->count())
                        <!--  <table class="table table-condensed table-striped"> -->
                        <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">

                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Descripcion</th>
                                    <th class="text-center">Active_flag</th>
                                    <th class="text-center">Branch_id</th>
                                    <th class="text-center">Branch_id</th>
                                    <th class="text-center">OPTIONS</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="text-center"><strong>{{$product->id}}</strong></td>

                                    <td class="text-center">{{$product->name}}</td>
                                    <td class="text-center">{{$product->description}}</td>
                                    <td class="text-center">{{$product->active_flag}}</td>
                                    <td class="text-center">{{$product->branch_id}}</td>
                                    <td class="text-center">{{$product->branch_id}}</td>

                                    <td class="text-right">
                                        <!-- <a class="btn btn-warning style-btn-edit" href="{{ url('productoShow', $product->id) }}"> -->
                                        <a class="btn btn-xs btn-primary" href="{{ url('productoShow', $product->id) }}">
                                            <a class="btn btn-xs btn-primary" href="{{ url('productoShow', $product->id) }}">
                                                <i class="glyphicon glyphicon-eye-open"></i> View
                                            </a>

                                            <a class="btn btn-xs btn-warning" href="{{ url('productoEdit', $product->id) }}">
                                                <!-- <a class="btn btn-warning style-btn-edit" href="{{ url('productoEdit', $product->id) }}"> -->
                                                <a class="btn btn-xs btn-warning" href="{{ url('productoEdit', $product->id) }}">
                                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                                </a>

                                                <!--form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');"-->
                                                <form action="#" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="_method" value="DELETE">

                                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                                </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $products->render() !!}
                        @else
                        <h3 class="text-center alert alert-info">Empty!</h3>
                        @endif

                    </div>
                </div>

                @endsection