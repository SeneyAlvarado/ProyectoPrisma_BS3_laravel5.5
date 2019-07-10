@extends('masterDesigner')
@section('contenido_Designer')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/js/Designer/designers.js')}}"></script>
<div style="padding:10px;">
    <div class="card margin-bottom-card" >
    <div class="card-header"><h5 style="text-align:center; ">Trabajos</h5></div>
    </div>
            
           <div class="">
            @if(count($works))
           <div class="table-responsive">
               <table class="table table-bordered table-condensed table-hover compact " id="tablaDatos">
                   <thead>
                        <th class="text-center">Número</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Estado</th> 
                        <th class="text-center">Diseñador</th> 
                        <th class="text-center">Ingreso</th>
                        <th class="text-center">Entrega</th>
                        <th class="text-center">Tiempo</th> 
                        <th class="text-center">Opciones</th>                         
                   </thead>

                   <tbody>
                       @foreach($works as $work)
                       <?php  
                            $date = explode("-", $work->approximate_date);
                            $year = $date[0];
                            $month = $date[1];
                            $day = $date[2];
                            $new_day_without_time = explode(" ", $day);
                            $day = $new_day_without_time[0];
                            $approximate_date = $day . "/" . $month . "/" . $year;
                            
                            
                            $date = explode("-", $work->entry_date);
                            $year = $date[0];
                            $month = $date[1];
                            $day = $date[2];
                            $new_day_without_time = explode(" ", $day);
                            $day = $new_day_without_time[0];
                            $entry_date = $day . "/" . $month . "/" . $year;


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
                               <td class="text-center">{{$work->work_id}} <span style="color:#E3BA00" class="glyphicon glyphicon-star"></span></td>
                               @else
                               <td class="text-center">{{$work->work_id}}</td>
                               @endif
                               <td class="text-center"><a class="infoClient"
                            onCLick="infoContact('{{$work->client_owner}}')">{{$work->client_name}}</a></td>

                            <td class="text-center" style="min-width:150px;">
                                @foreach ($designer as $d)
                                    @if($d->id == $work->designer_id)
                                    {{$d->name . " " . $d->lastname}}
                                    @endif
                                @endforeach
                                
                            </td>

                            <td class="text-center" style="min-width:150px;">
                                <div class="dropdown" style="display: block">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" id="dropDesigner{{$work->work_id}}"
                                        data-target="#drop-designers" href="#" value="{{$actualDesignerID}}"
                                            role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{$actualDesignerName}}
                                        </button>
                                    <div class="dropdown-menu" id="#drop-designers" name="dropOtherDesigners{{$work->work_id}}" 
                                        aria-labelledby="dropdownMenuLink">
        
                                        @foreach ($designer as $desig)
                                        @if($desig->id != $actualDesignerID)
                                    <button class="dropdown-item" id="workDesigner{{$work->work_id}}{{$desig->id}}" 
                                        onclick="changingDesigner('{{$work->work_id}}', '{{$desig->id}}', '{{$desig->name . ' ' . $desig->lastname}}')">
                                        {{$desig->name . ' ' . $desig->lastname}}</button>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </td>

                               <td class="text-center">{{$entry_date}}</td>
                               <td class="text-center">{{$approximate_date}}</td>
                               @if ($work->color == "red")
                               <td  class="text-center"><strong>{{$work->time_left}} </strong><span style="color:#C20202" class="glyphicon glyphicon-time"></span></td>
                                @elseif ($work->color == "green")
                                <td  class="text-center"><strong>{{$work->time_left}} </strong><span style="color:#0FA001" class="glyphicon glyphicon-time"></span></td>
                                @else
                                <td class="text-center"><strong>{{$work->time_left}} </strong><span style="color:#DFAC02" class="glyphicon glyphicon-time"></span></td>
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
                                    <a class="btn btn-warning style-btn-edit btn-size btn-sm"  onCLick="workDetails('{{$work->work_id}}')">Detalles</a>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>

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
                                readonly style="resize:none"></textarea>
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
                        <label for="name"><strong>Número de orden:&nbsp</strong></label><label id="order_id" value=" " type="text" name="order_id"></label>
                        <br>
                        <label for="name"><strong>Número de trabajo:&nbsp</strong></label><label id="work_id" value=" " type="text" name="work_id"></label>
                        <br>
                        <label for="name"><strong>Prioridad:&nbsp</strong></label><label id="priority" value=" " type="text" name="priority"></label>
                        <br>
                        <label for="name"><strong>Adelanto de pago:&nbsp</strong></label><label id="payment" value=" " type="text" name="payment"></label>
                        <br>
                        <label for="name"><strong>Fecha de ingreso:&nbsp</strong></label><label id="entry_date" value=" " type="text" name="entry_date"></label>
                        <br>
                        <label for="name"><strong>Fecha de entrega:&nbsp</strong></label><label id="delivery_date" value=" " type="text" name="delivery_date"></label>   
                    </div>
                    <div class="col-md-6 " style="padding:15px;">
                        <label for="name"><strong>Producto :&nbsp</strong></label><label id="product" value=" " type="text" name="product"></label>
                        <br>
                        <label for="name"><strong>Ingreso a diseño:&nbsp</strong></label><label id="designer" value=" " type="text" name="designer"></label>
                        <br>
                        <label for="name"><strong>Ingreso a impresión:&nbsp</strong></label><label id="print" value=" " type="text" name="print"></label>
                        <br>
                        <label for="name"><strong>Ingreso a post-producción:&nbsp</strong></label><label id="post_production" value=" " type="text" name="post_production"></label>
                        <br>
                        <label for="name"><strong>Horas de secado :&nbsp</strong></label><label id="dry" value=" " type="text" name="dry"></label>
                        <br>
                    </div>
                    <div class="col-md-10" >
                    <textarea class="form-control" rows="4" name="observation" id="observation" style="resize:none" readonly></textarea>
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

<script src="{{asset('/js/Works/tableWorksWithoutCreate.js')}}"></script>
<script src="{{asset('/js/Client_contacts/show_contact.js')}}"></script>

<script src="{{asset('/js/Works/work_details.js')}}"></script>



@endsection