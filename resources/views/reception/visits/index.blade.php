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
                            <table class="table table-striped table-bordered table-condensed table-hover compact" id="tablaDatos">
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
                                            <button type="button" data-toggle="modal" class="btn btn-warning style-btn-edit btn-size btn-sm"  
                                            onClick="fillVisitInfo('{{$visit->id}}', '{{$visit->client_name}}', '{{$visit->phone}}' , '{{$visit->email}}', '{{$visit->visitor}}', '{{\Carbon\Carbon::parse($visit->date)->format('d/m/Y')}}', '{{$visit->details}}')" >Detalles</button>
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

    <div class="modal fade" id="showVistInfo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Información de visita</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    
                    <div >
                        <label style="margin: 0;"><strong>Cliente:&nbsp</strong></label><label
                         id="clientName" value=" " type="text" name="clientName"></label>
                    </div>
                    <div >
                        <label style="margin: 0;"><strong>Teléfono:&nbsp</strong></label><label
                         id="phone" value=" " type="text" name="phone"></label>
                    </div>
                    <div >
                        <label style="margin: 0;"><strong>Correo:&nbsp</strong></label><label
                         id="email" value=" " type="text" name="email"></label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div >
                        <label style="margin: 0;"><strong>N° visita:&nbsp</strong></label><label
                         id="id" value=" " type="text" name="id"></label>
                    </div>
                    <div >
                        <label style="margin: 0;"><strong>Fecha:&nbsp</strong></label><label
                         id="date" value=" " type="text" name="date"></label>
                    </div>
                    <div >
                        <label style="margin: 0;"><strong>Encargado:&nbsp</strong></label><label
                         id="visitor" value=" " type="text" name="visitor"></label>
                    </div>
                </div>
                <div class="col-md-10">
                    <div >
                        <label style="margin: 0;"><strong>Detalle:&nbsp</strong></label><label
                         id="details" value=" " type="text" name="details"></label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<script src="{{asset('/js/Visits/table.js')}}"></script>
<script src="{{asset('/js/Visits/fillVisitInfo.js')}}"></script>
@endsection

