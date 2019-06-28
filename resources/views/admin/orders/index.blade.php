@extends('masterAdmin')
@section('contenido_Admin')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<!-- Styles elements of the order-->
<link rel="stylesheet" href="{{asset('/css/order.css')}}">

<div class="card margin-bottom-card" style="margin-top:10px;">
    <h5 class="card-header" style="text-align:center">Órdenes</h5>
</div>

<div class="">
    @if($orders->count())

    <div class="table-responsive">
        <table style="overflow: visible !important;"
            class="table table-striped table-bordered table-drop table-condensed table-hover compact order-column"
            id="tablaDatos">
            <thead>
                <th class="text-center">Orden</th>
                <th class="text-center">Cotización</th>
                <th class="text-center">Cliente</th>

                <th class="text-center" style="min-width:150px;">Estado</th>
                <th class="text-center">Contacto</th>
                <th class="text-center">Opciones</th>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <?php  
                    $actualStateName = "";
                    $actualStateID = "";
                    //both arrays are being used, do not erase
                    
                    foreach ($order_states as $order_state) {
                       if($order_state->id == $order->last_order_state_id){
                        $actualStateID = $order_state->id;
                        $actualStateName = $order_state->name;
                       }
                    }
                
                        //$date = explode("-", $order->approximate_date);
                       // $year = $date[0];
                        //$month = $date[1];
                        //$day = $date[2];
                       // $new_day_without_time = explode(" ", $day);
                        //$day = $new_day_without_time[0];
                        //$approximate_date = $day . "/" . $month . "/" . $year;
                ?>
                <tr>
                    <td class="text-center">{{$order->id}}</td>
                    <td class="text-center">{{$order->quotation_number}}</td>
                    <td class="text-center"><a class="infoClient"
                            onCLick="infoContact('{{$order->client_owner}}')">{{$order->client_owner_name}}</a></td>

                    <td class="text-center" style="min-width:150px;">
                        <div class="dropdown" style="display: block">
                            <a class="btn btn-secondary btn-sm dropdown-toggle" data-target="#drop-states" href="#"
                                role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{$actualStateName}}
                            </a>

                            <div class="dropdown-menu" id="#drop-states" aria-labelledby="dropdownMenuLink">

                                @foreach ($order_states as $order_state)
                                @if($order_state->id != $actualStateID)
                                <a class="dropdown-item" href="{{$order_state->id}}">{{$order_state->name}}</a>
                                @endif
                                @endforeach
                            </div>
                            <div class="progress" style="text-align: center; margin-top: 5px;">
                                <strong class="percentage-text">{{ $order->finished_percentage. "%"}}</strong>
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                                    style="{{"width:" . $order->finished_percentage. "%"}}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><a class="infoClient"
                            onCLick="infoContact('{{$order->client_contact}}')">{{$order->client_contact_name}}</a></td>

                    <td class="text-center">
                        <a class="btn btn-warning" href="{{url('reportOrder', $order->id)}}"
                            style="background-color:#e0e0e0; border:0px;"><span
                                class="glyphicon glyphicon-file"></span></a>
                        <a class="btn btn-warning" style="background-color:#e0e0e0; border:0px;" href=""><span
                                class="glyphicon glyphicon-folder-open"></a>
                        <a class="btn btn-warning" href="" style="background-color:#e0e0e0; border:0px;"><span
                                class="glyphicon glyphicon-pencil"></span></a>
                        @if($order->active_flag == 1)
                        <form style="display:inline" action="" method="POST" style="display: inline;"
                            onsubmit="return confirm('Desea cancelar la orden de {{$order->client_owner_name}}?');">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn style-btn-delete btn-danger btn-size "><span
                                    class="glyphicon glyphicon-ban-circle"></span></button>
                        </form>
                        @else
                        <form style="display:inline" action="" method="POST" style="display: inline;"
                            onsubmit="return confirm('Desea activar la orden de {{$order->$client_owner_name}}?');">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-success style-btn-success btn-size">Activar</button>
                        </form>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    <a class="btn btn-success style-btn-registry" href="{{ route('orders.create') }} "
        style="margin-bottom: 10px; ">Crear orden </a>
    <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
    @endif

    <!-- The Modal Contact Information-->
    <div class="modal fade" id="modalContact">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Información de contacto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <label for="id"><strong>Cédula</strong></label>
                            <input id="identification-field" value="" class="form-control" name="identification"
                                type="text" readonly>
                        </div>
                        <div class="col-md-5">
                            <label for="name"><strong>Nombre</strong></label>
                            <input id="name-field" value="" class="form-control" name="name" type="text" readonly>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <label for="id"><strong>Teléfono</strong></label>
                            <input id="identification-field" value="" class="form-control" name="phone" type="text"
                                readonly>
                        </div>
                        <div class="col-md-5">
                            <label for="name"><strong>Correo</strong></label>
                            <input id="name-field" value="" class="form-control" name="email" type="text" readonly>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <label for="id"><strong>Dirección</strong></label>
                            <textarea class="form-control" value="" rows="5" id="comment" name="address"
                                readonly></textarea>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/lenguajeTabla.js')}}"></script>
    <script src="{{asset('js/show_contact.js')}}"></script>



    @endsection