@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Estados</h5>
            <div class="card-body">
                <div class="container-fluid">
                    <div> 
                        <a class="btn btn-success style-btn-registry" href="{{ url('crearEstados') }} " style="margin-bottom: 10px; ">Crear </a>
                    </div>
                <div class="">
                    @if($states->count())
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
                            <thead>
                                    <th class="text-center">Nombre</th> 
                                    <th class="text-center">Descripcion</th> 
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Opciones</th>                   
                            </thead>
                            <tbody>
                                @foreach($states as $state)
                                <tr>
                                    <td class="text-center">{{$state->name}}</td> 
                                    <td class="text-center">{{$state->description}}</td> 
                                    @if($state->active_flag ==1)
                                    <td class="text-center">Activo</td>
                                    @else
                                    <td class="text-center">Desactivo</td>
                                    @endif
                                    <td class="text-center">
                                        <a class="btn btn-warning style-btn-edit btn-size" href="{{ url('editarEstados', $state->id) }}">Detalles</a>
                                        <form action="{{ url('eliminarEstados', $state->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar este elemento?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn  style-btn-delete btn-danger btn-size">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
                    @endif
                </div>
            </div>
        </div> 
    </div> 
</div>
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection

