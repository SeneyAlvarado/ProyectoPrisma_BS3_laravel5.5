@extends('masterReception')
@section('content_Reception')
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
                                    <th class="text-center">Opciones</th>                       
                                </thead>
                                <tbody>
                                    @foreach($visits as $visit)
                                    @if($visit->active_flag != 0)
                                        <tr>
                                            <td class="text-center"><strong>{{$visit->id}}</strong></td>    
                                            <td class="text-center">{{$visit->client_name}}</td> 
                                            <td class="text-center">{{\Carbon\Carbon::parse($visit->date)->format('d/m/Y')}}</td> 
                                            <td class="text-center">{{$visit->phone}}</td> 
                                            <td class="text-center">{{$visit->email}}</td> 
                                            <td class="text-center">{{$visit->visitor}}</td>
                                            <td class="text-center">
                                            <a class="btn btn-warning style-btn-edit btn-size btn-sm"  href="{{ url('editVisit', $visit->id) }}">Detalles</a>
                                            <form action="{{ route('visits.solve', $visit->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea resolver la visita {{$visit->id}}?');">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                                @if ($visit->active_flag == 3)
                                                <button type="submit" class="btn  style-btn-solve btn-danger btn-sm" style="color:#333333" disabled>Resolver</button>
                                                @else
                                                <button type="submit" class="btn  style-btn-success btn-danger btn-sm">Resolver</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
                        @endif
        </div> 
    </div>
<script src="{{asset('/js/Visits/table.js')}}"></script>
@endsection

