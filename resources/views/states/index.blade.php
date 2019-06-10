@extends('masterPrueba3')

@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<div style="padding:10px;">

    <div class="panel panel-primary border-panel">
        <div class="panel-heading  border-header bg-color-panel" >
            <p class="title-panel" style="font-size:20px;">Estados</p>
        </div>
        <div class="panel-body">
            <div class="content-c w3-container mobile">
                <div> 
                    <a  class="btn btn-success style-btn-registry" href="{{ url('crearEstados') }}" style="margin-bottom: 10px; ">Crear Estado </a>
                                   
                </div>
                @if($states->count())
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th> 
                                <th class="text-center">Descripcion</th> 
                                <th class="text-center">Estado</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($states as $state)
                                <tr>
                                    <td class="text-center">{{$state->name}}</td> 
                                    <td class="text-center">{{$state->description}}</td> 
                                    <td class="text-center">{{$state->active_flag}}</td>
                                    @if($state->active_flag ==1)
                                    <td class="text-center">Activo</td>
                                    @else
                                    <td class="text-center">Desactivo</td>
                                    @endif
                                    <td class="text-center">                                   
                                        <a class="btn btn-xs btn-warning" href="{{ url('editarEstados', $state->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> Detalles
                                        </a>
                                        <form action="{{ url ('eliminarEstados', $state->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar este elemento?');">
                                        {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Desactivar</button>
                                        </form>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                {!! $states->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay estados disponibles para mostrar</h3>
            @endif

        </div>
    </div>
    </div>
</div>

@endsection