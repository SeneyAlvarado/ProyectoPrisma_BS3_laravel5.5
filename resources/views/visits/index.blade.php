@extends('masterPrueba3')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">

    <div class="panel panel-primary border-panel">
        <div class="panel-heading  border-header bg-color-panel" >
            <p class="title-panel" style="font-size:20px;">Visitas</p>
        </div>
        <div class="panel-body">
           <div class="content-c w3-container mobile">
                <div> 
                   <a  class="btn btn-success style-btn-registry" href="{{ url('crearVisita') }}" style="margin-bottom: 10px; ">Crear </a>    
            </div>

            @if($visits->count())
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <th class="text-center">N° visita</th>
                            <th class="text-center">Nombre cliente</th> 
                            <th class="text-center">Fecha</th> 
                            <th class="text-center">Teléfono</th> 
                            <th class="text-center">Correo</th>
                            <th class="text-center">Encargado visita</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opciones</th>
                    </thead>

                    <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td class="text-center"><strong>{{$visit->id}}</strong></td>

                                <td class="text-center">{{$visit->client_name}}</td> 
                                <td class="text-center">{{$visit->date}}</td> 
                                <td class="text-center">{{$visit->phone}}</td> 
                                <td class="text-center">{{$visit->email}}</td> 
                                <td class="text-center">{{$visit->visitor_id}}</td> 
                                <td class="text-center">{{$visit->active_flag}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-warning" href="{{ url('editarVisita', $visit->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Detalles
                                    </a>

                                    <form action="{{ url('eliminarVisita', $visit->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar este elemento?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                {!! $visits->render() !!}
            @else
                <h3 class="text-center alert alert-info">No hay estados disponibles para mostrar</h3>
            @endif

        </div>
    </div>
    </div>
</div>
@endsection