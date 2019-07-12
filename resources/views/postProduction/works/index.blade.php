@extends('masterPostProduction')
@section('content_PostProduction')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/js/Works/changeWorkStates_printHours.js')}}"></script>
<div style="padding:10px;">
    <div class="card margin-bottom-card">
        <div class="card-header">
            <h5 style="text-align:center; ">Trabajos</h5>
        </div>
    </div>
    <input type='hidden' id='work_id' name='work_id' value=''>
    <input type='hidden' id='state_id' name='state_id' value=''>
    <input type='hidden' id='state_name' name='state_name' value=''>
    <div class="">
        @if(count($works))
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover compact " id="tablaDatos">
                <thead>
                    <th class="text-center">N°</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Secado</th>
                    <th class="text-center">Entrega</th>
                    <th class="text-center">Tiempo</th>
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                    <?php
                        $workCounter = 0;
                    ?>
                    @foreach($works as $work)
                    <?php  
                        $actualStateName = "";
                        $actualStateID = "";
                        //both arrays are being used, do not erase
                        foreach ($work_states as $work_state) {
                            if($work_state->id == $work->work_state){
                                $actualStateID = $work_state->id;
                                $actualStateName = $work_state->name;
                            }
                        }
                        ?>
                    <tr class="">
                        @if ($work->priority == 1)
                        <td class="text-center">{{$work->work_id}} <span style="color:#E3BA00"
                                class="glyphicon glyphicon-star"></span></td>
                        @else
                        <td class="text-center">{{$work->work_id}}</td>
                        @endif
                        <td class="text-center"><a class="infoClient"
                                onCLick="infoContact('{{$work->client_owner}}')">{{$work->client_name}}</a></td>

                        <td class="text-center" style="min-width:150px;">
                            <div class="dropdown" style="display: block">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" id="drop{{$work->work_id}}"
                                    data-target="#drop-states" href="#" value="{{$actualStateID}}" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{$actualStateName}}
                                </button>

                                <div class="dropdown-menu" id="#drop-states" name="dropOtherStates{{$work->work_id}}"
                                    aria-labelledby="dropdownMenuLink">

                                    @foreach ($work_states as $work_state)
                                    @foreach ($editStates as $editState)
                                    @if(($work_state->id == $editState->id) && ($work_state->id != $actualStateID))
                                    <button class="dropdown-item" id="workState{{$work->work_id}}{{$work_state->id}}"
                                        onclick="changeWorkState('{{$work->work_id}}', '{{$work_state->id}}', '{{$work_state->name}}')">{{$work_state->name}}</button>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <p id="miliTime{{$workCounter}}" val="{{strtotime($work->post_production_date) * 1000 }}">-
                            </p>
                        </td>
                        <td class="text-center">{{\Carbon\Carbon::parse($work->approximate_date)->format('d/m/Y')}}</td>
                        @if ($work->color == "red")
                        <td class="text-center"><strong>{{$work->time_left}}
                            </strong><span style="color:#C20202" class="glyphicon glyphicon-time"></span></td>
                        @elseif ($work->color == "green")
                        <td class="text-center"><strong>{{$work->time_left}} </strong><span style="color:#0FA001"
                                class="glyphicon glyphicon-time"></span></td>
                        @else
                        <td class="text-center"><strong>{{$work->time_left}} </strong><span style="color:#DFAC02"
                                class="glyphicon glyphicon-time"></span></td>
                        @endif

                        <!--<td class="text-center "><strong>{{$work->time_left}}</strong></td>-->
                        <!--@if ($work->color == "red")
                                <td style="color:red;" class="text-center "><strong>{{$work->time_left}}</strong></td>
                                @elseif ($work->color == "green")
                                <td style="color:blue;" class="text-center "><strong>{{$work->time_left}}</strong></td>
                                @else
                                <td style="color:#E3BA00;" class="text-center "><strong>{{$work->time_left}}</strong></td>
                                @endif-->

                        <td class="text-center">
                            <a class="btn btn-warning style-btn-edit btn-size btn-sm"
                                onCLick="workDetails('{{$work->work_id}}')">Detalles</a>
                            <a class="btn style-btn-delete btn-size btn-sm"
                                href="{{route('orders.edit', [$work->order_id])}}">&nbsp; Orden &nbsp;</a>
                        </td>
                    </tr>
                    <?php
                        $workCounter = $workCounter+1;
                    ?>
                    @endforeach
                </tbody>
            </table>
            <input id="workCounter" type="hidden" value="{{$workCounter}}">
        </div>

        @else
        <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
        @endif

        <!-- The Modal Contact Information-->
        <div class="modal fade" id="modalContact">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Información del cliente</h4>
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

        <div class="modal fade" id="editModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detalle de trabajo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-5 offset-md-1" style="padding:15px; ">
                                <label for="name"><strong>Número de orden:&nbsp</strong></label><label id="order_id"
                                    value=" " type="text" name="order_id"></label>
                                <br>
                                <label for="name"><strong>Número de trabajo:&nbsp</strong></label><label id="work_ids"
                                    value=" " type="text" name="work_ids"></label>
                                <br>
                                <label for="name"><strong>Prioridad:&nbsp</strong></label><label id="priority" value=" "
                                    type="text" name="priority"></label>
                                <br>
                                <label for="name"><strong>Adelanto de pago:&nbsp</strong></label><label id="payment"
                                    value=" " type="text" name="payment"></label>
                                <br>
                                <label for="name"><strong>Fecha de ingreso:&nbsp</strong></label><label id="entry_date"
                                    value=" " type="text" name="entry_date"></label>
                                <br>
                                <label for="name"><strong>Fecha de entrega:&nbsp</strong></label><label
                                    id="delivery_date" value=" " type="text" name="delivery_date"></label>
                            </div>
                            <div class="col-md-6 " style="padding:15px;">
                                <label for="name"><strong>Producto :&nbsp</strong></label><label id="product" value=" "
                                    type="text" name="product"></label>
                                <br>
                                <label for="name"><strong>Ingreso a diseño:&nbsp</strong></label><label id="designer"
                                    value=" " type="text" name="designer"></label>
                                <br>
                                <label for="name"><strong>Ingreso a impresión:&nbsp</strong></label><label id="print"
                                    value=" " type="text" name="print"></label>

                                <br>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="4" name="observation" id="observation"
                                    readonly></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal Contact Information-->
        <div class="modal fade" id="modalHours">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detalles adicionales</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <label for="dry_hours"><strong>Horas de secado</strong></label>
                                <input id="dry_hours" value="" class="form-control" name="dry_hours" type="number">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="style-btn-success btn-block margin-button btn btn-info"
                            onclick="checkDryingHoursModal();">Guardar</button>
                        <button type="button" class="btn btn-secondary  btn-block" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addFile">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Adjuntar diseño</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method='POST' action='javascript:formInitiation();' id="fileForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="">

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <label for="name"><strong>Seleccione un diseño</strong></label>
                                    <input id="design" name="design" class="form-control hideFile" type="file">

                                </div>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <button style="margin-top:15px;" id="update"
                                        class='style-btn-success btn-block margin-button btn btn-info'
                                        type='submit'>Guardar</button>
                                </div>
                                <div class="col-md-4">
                                    <button style="margin-left:1px; margin-top:15px;"
                                        class='btn-block margin-button btn btn-default'
                                        data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">

                    </div>

                </div>
            </div>
        </div>

        <script src="{{asset('/js/tableWithoutCreateOrder.js')}}"></script>
        <script src="{{asset('/js/Client_contacts/show_contact.js')}}"></script>

        <script src="{{asset('/js/Works/work_details.js')}}"></script>
        <script src="{{asset('/js/Works/addFiles.js')}}"></script>
        <script src="{{asset('/js/Works/calculateDryHours.js')}}"></script>




        @endsection