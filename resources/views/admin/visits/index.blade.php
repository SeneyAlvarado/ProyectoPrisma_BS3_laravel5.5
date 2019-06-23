@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
        <div class="card margin-bottom-card">
            <div class="card-header">
                <h5 style="text-align:center; ">Visitas</h5>
            </div>
        </div>
        <div class="">
                        @if($visits->count())
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
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
                                    @if($visit->active_flag == 1)
                                        <tr>
                                            <td class="text-center"><strong>{{$visit->id}}</strong></td>    
                                            <td class="text-center">{{$visit->client_name}}</td> 
                                            <td class="text-center">{{\Carbon\Carbon::parse($visit->date)->format('d/m/Y')}}</td> 
                                            <td class="text-center">{{$visit->phone}}</td> 
                                            <td class="text-center">{{$visit->email}}</td> 
                                            <td class="text-center">{{$visit->visitor_id}}</td>
                                            <td class="text-center">Activo</td>
                                            <td class="text-center">
                                                <a class="btn btn-warning style-btn-edit btn-size"  href="{{ url('editVisit', $visit->id) }}">Detalles</a>
                                                <form action="{{ url('deleteVisit', $visit->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar este elemento?');">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn  style-btn-delete btn-danger btn-size">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <a class="btn btn-success style-btn-registry" href="{{ url('visits.create') }} " style="margin-bottom: 10px; ">Registrar </a>
                        <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
                        @endif
        </div> 
    </div>
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection

