@extends('masterAdmin')
@section('contenido_Admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">
    <div class="card margin-bottom-card">
        <div class="card-header">
            <h5 style="text-align:center; ">Productos</h5>
        </div>
    </div>
    <div class="">

        @if($products->count())
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
                <thead>
                    <tr>
                        <th class="text-center">Número</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Sucursal</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="text-center"><strong>{{$product->id}}</strong></td>
                        <td class="text-center">{{$product->name}}</td>
                        <td class="text-center">{{$product->description}}</td>
                        @if($product->active_flag == 1)
                        <td class="text-center">Activo</td>
                        @else
                        <td class="text-center">Inactivo</td>
                        @endif
                        <td class="text-center">{{$product->branch_idd}}</td>
                        <td class="text-center">
                            <a class="btn btn-warning style-btn-edit btn-size btn-sm" href="{{ route('products.edit', $product->id) }}"> Editar</a>
                            @if($product->active_flag == 1)
                            <form style="display:inline" action="{{ route('products.deactivate', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el producto {{$product->name}}');">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn style-btn-delete btn-danger btn-size btn-sm">Desactivar</button>
                            </form>
                            @else
                            <form style="display:inline" action="{{ route('products.activate', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el producto {{$product->name}}');">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-success style-btn-success btn-size btn-sm">Activar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <a class="btn btn-success style-btn-registry" href="{{ url('products.create') }} " style="margin-bottom: 10px; ">Registrar </a>
        <h3 class="text-center alert alert-info">No hay nada para mostrar!</h3>
        @endif
    </div>
</div>
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection