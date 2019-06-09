@extends('masterAdmin')

@section('contenido_Admin')
<div class="page-header clearfix">
    <h1>
        Estados
        <a class="btn btn-success pull-right" href="{{ url('crearEstados') }}">
            <i class="glyphicon glyphicon-plus"></i> Crear</a>
    </h1>
</div>
    <div class="row">
        <div class="col-md-12">
            @if($states->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre</th> <th>Descripcion</th> <th>Estado</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($states as $state)
                            <tr>
                                <td class="text-center"><strong>{{$state->id}}</strong></td>

                                <td>{{$state->name}}</td> <td>{{$state->description}}</td> <td>{{$state->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ url('verEstados', $state->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> Detalles
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ url('editarEstados', $state->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Editar
                                    </a>
                                    <form action="{{ url ('eliminarEstados', $state->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Desactivar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $states->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay estados disponibles para mostrar</h3>
            @endif

        </div>
    </div>

@endsection