@extends('masterAdmin')
@section('contenido_Admin')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
        <div class="card margin-bottom-card">
                <div class="card-header">
                    <h5 style="text-align:center; ">Estados</h5>
                </div>
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
                                        <a class="btn btn-warning style-btn-edit btn-size" href="{{ url('editState', $state->id) }}">Detalles</a>
                                        @if($state->active_flag == 1)
                                   <form style="display:inline" action="{{ url('deactivateState', $state->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea desactivar el estado {{$state->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn style-btn-delete btn-danger btn-size btn-sm">Desactivar</button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="{{ url('activateState', $state->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea activar el estado {{$state->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit"  class="btn btn-success style-btn-success btn-size btn-sm">Activar</button>
                                   </form>
                                   @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <a class="btn btn-success style-btn-registry" href="{{ url('states.create') }} " style="margin-bottom: 10px; ">Registrar </a>
                    <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
                    @endif
    </div> 
</div>
<script src="{{asset('/js/lenguajeTabla.js')}}"></script>
@endsection

