@extends('masterAdmin')
@section('contenido_Admin')

<script src="{{asset('js/load_branches_admin.js')}}"></script>
<script src="{{asset('js/check_clients_branch_select.js')}}"></script>
<script src="{{asset('/js/filter_client_selects.js')}}"></script>

<script src="{{asset('js/load_clients.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
</script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/api/fnReloadAjax.js"></script>
<script src="{{asset('/js/dateTimePicker_minDateToday.js')}}"></script>
<script src="{{asset('/js/datetimepicker_editModal.js')}}"></script>
<script src="{{asset('/js/order_multistep_form.js')}}"></script>
<script src="{{asset('/js/multiple-materials-select.js')}}"></script>
<script src="{{asset('/js/multiple-material-editModal.js')}}"></script>
<script src="{{asset('/js/load_materials.js')}}"></script>
<script src="{{asset('/js/load_products_branch.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/css/order_multistep_form.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/multiple-materials-select.css')}}">



  
    

<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Órdenes</h5>
        <div class="card-body">
            <div class="container-fluid">
                <div class="">
                    <form method='POST' action='{{ route("orders.store") }}' id="orderForm">
                        <!-- onsubmit="return check_clients_branch_select(this)" -->
                        <input type='hidden' id='_token' name='_token' value='{{Session::token()}}'>
                        <input type='hidden' id='dolarExchangeRate' value='{{$dolarRate}}'>
                        <input type='hidden' id='hiddenDateCR'
                            value='{{\Carbon\Carbon::now('America/Costa_Rica')->addDay(7)->format('d/m/Y')}}'>
                        <input type='hidden' id='editRow' value=''>


                        <div class="tab">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div>
                                        <label style="margin: 0;" ><strong>Cliente:&nbsp</strong></label><label id="client_name" value=" " type="text" name="client_name"></label>
                                        <button style="margin-left:5px;" type="button" class="btn btn-secundary style-btn-search btn-sm" style="width:50px !important; margin:0px;" onClick="listClientsTable()">Buscar</button>
                                    </div>
                                    <div id="hideId" style="display:none;">
                                        <label style="margin: 0;" ><strong>Cédula:&nbsp</strong></label><label id="identification" value=" " type="text" name="identification"></label>
                                    </div>
                                    <div id="hidePhone" style="display:none;">
                                        <label style="margin: 0;" ><strong>Teléfono:&nbsp</strong></label><label id="phone" value=" " type="text" name="phone"></label>
                                    </div>
                                    <div id="hideEmail" style="display:none;">
                                        <label style="margin: 0;" ><strong>Correo:&nbsp</strong></label><label id="email" value=" " type="text" name="email"></label>
                                    </div>
                                    <input type="hidden" class="form-control" id="client_id" name="client_id">
                                </div>
                                
                                <div class="col-md-3 ">
                                    <div id="hide_quotation" style="display:none;">
                                        <label style="margin: 0;" for="quotation_number"><strong>Número Cotización</strong></label>
                                        <input id="quotation_number" placeholder="# Cotización" class="form-control"
                                            name="quotation_number" type='text' pattern="[0-9]*" title="No se permite ingresar letras ni números con decimales o negativos 
                                            en este campo" min=”0″>
                                    </div>
                                    <div id="hide_total" style="display:none;">
                                        <label style="margin: 0px; margin-top: 10px;" for="order_total"><strong>Total de la orden</strong></label>
                                        <input id="order_total" placeholder="Monto total de la orden" class="form-control"
                                            name="order_total" type='text'
                                            title="No se permite ingresar letras o números negativos en este campo"
                                            value="0" min=”0″ step=any onkeyup="showConvertedTotal()">
                                        <p id="pOrder" style="display:none"></p>
                                    </div>
                                </div>
                                <div class="col-md-3" >
                                    <div id="hide_money" style="display:none; paddign-left:10px;" class="input-group row justify-content-center">
                                        <label for="branch"><strong>Moneda de transacción</strong></label>
                                        <span class="radio">
                                            <label style="margin: 0;">Colones</label>
                                            <label>
                                                <input id="colones" type="radio" value="0" class="radiobox" name="coin">
                                            </label>

                                            <label style="margin: 0;">
                                                <label style="margin-left:20px;">Dólares</label>
                                                <input id="dolars" type="radio" value="1" class="radiobox" name="coin"
                                                    checked>
                                            </label>
                                        </span>
                                    </div>
                                    <div id="hide_advancement" style="display:none;">
                                        <label style="margin:0; margin-top: 8px;" for="order_advanced_payment"><strong>Adelanto de pago</strong></label>
                                        <input id="order_advanced_payment" placeholder="Monto del adelanto"
                                            class="form-control" name="order_advanced_payment" type='text'
                                            title="No se permite ingresar letras o números negativos en este campo"
                                            value="0" min=”0″ step=any onkeyup="showConvertedAdvanced()">
                                        <p id="pAdvanced" style="display:none"></p>
                                    </div>
                                </div> 
                            </div>


                            <div class="row " style=" margin-bottom:10px;">
                                <div class="col-md-3 offset-md-2">
                                    <label for="user_name"><strong>Buscar cliente</strong></label>
                                    <input type="text" placeholder="Buscar cliente" class="form-control"
                                        id="searchOwnerInput" onkeyup="searchOwner()">
                                </div>
                            </div>
                            <div class="row justify-content-center">

                                <div class="col-md-8 align-self-center">

                                    <select size="4" class="form-control" id="selectList" name="owner_client">
                                    </select>
                                </div>
                            </div>

                            <div class="row " style="margin-top:15px; margin-bottom:10px;">
                                <div class="col-md-3 offset-md-2">
                                    <label for="user_name"><strong>Buscar contacto</strong></label>
                                    <input type="text" class="form-control" placeholder="Buscar contacto"
                                        id="searchContactInput" onkeyup="searchContact()">
                                </div>
                            </div>
                            <div class="row justify-content-center">

                                <div class="col-md-8 align-self-center">

                                    <select size="4" class="form-control" id="selectList_contact" name="contact_client">
                                    </select>
                                </div>
                            </div>
                            <br>
                            <!--div class="row justify-content-center">
                                    <label for="branch"><strong>¿Posee adelanto
                                            económico?</strong></label>
                                    <div class="input-group row justify-content-center" id="advance_payment_add">
                                        <span class="radio">
                                            <label>Sí</label>
                                            <label>
                                                <input id="payment_add1" type="radio" value="1" class="radiobox"
                                                    name="advance_payment_add">
                                            </label>

                                            <label>
                                                <label style="margin-left:20px;">No</label>
                                                <input id="payment_add0" type="radio" value="0" class="radiobox"
                                                    name="advance_payment_add" checked>
                                            </label>
                                        </span>
                                    </div>
                            </div-->
                            <div class="row justify-content-center">
                                
                            </div>
                            <div class="row justify-content-center">
                                
                            </div>
                        </div>

                        <!-- Here we had the advanced payment, it was moved to the Work-->
                        <!----------------------------------------------------------------- TAB 2 ------------------------------------------->
                        <div class="tab">

                            <div class="row justify-content-center">
                                <div class="table-responsive">
                                    <div id="tableDiv" style="display:">
                                        <table style="overflow: visible !important;"
                                            class="table table-striped table-bordered table-drop table-condensed table-hover compact order-column"
                                            id="worksTable">
                                            <thead>
                                                <th class="text-center">Fecha de entrega</th>
                                                <th class="text-center">Prioridad</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Opciones</th>
                                            </thead>

                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <!-- The Modal Add work Information-->
                            <div class="modal fade" id="modalWork">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Trabajo</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                            <div class="col-md-5">
                                                <label for="avatar"><strong>Adjuntar archivo</strong></label>
                                                <input id="avatar" class="form-control" name="avatar" type="file">
                                            </div>    
                                                <div class="col-md-5">
                                                    <label for="date-field"><strong>Fecha de entrega</strong></label>
                                                    <div class="input-group date" id="datetimepicker4"
                                                        data-target-input="nearest">
                                                        <input id="dateInput_add" type="text" name="date"
                                                            class="form-control datetimepicker-input"
                                                            data-target="#datetimepicker4" onkeydown="return false">
                                                        <div class="input-group-append" data-target="#datetimepicker4"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><span
                                                                    class="glyphicon glyphicon-calendar"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            
                                            <div class=" row ">
                                                <div class="col-md-3 offset-md-1">
                                                    <label for="user_name"><strong>Buscar producto</strong></label>
                                                    <input type="text" class="form-control" placeholder="Buscar producto" id="searchProductInput" onkeyup="searchProduct()">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-10 align-self-center">
                                                
                                                    <select size="4" style="margin-top:8px;" class="form-control" id="product_branch"
                                                        name="product_branch">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center" style="margin-top:20px;">
                                                <div class="col-md-10">
                                                    <label for="observation_add"><strong>Observaciones
                                                            Adicionales</strong></label>
                                                    <textarea class="form-control" onkeyup="countCharsAddModal(this);"
                                                        value="" rows="4" id="observation_add"
                                                        name="observation_add"></textarea>
                                                    <p id="charNumAdd">0 caracteres</p>
                                                </div>
                                            </div>
                                            <div class=" row ">
                                                <div class="col-md-3 offset-md-1">
                                                    <label for="user_name"><strong>Buscar materiales</strong></label>
                                                    <input type="text" class="form-control" placeholder="Buscar materiales" id="searchOriginInputAdd" onkeyup="searchOriginAdd()">
                                                </div>
                                            </div>
                                            
                                            <div class="row justify-content-center" style="margin-top:8px;">
                                                <div class="col-md-4">
                                                    <select multiple class="form-control" name="origen" id="origen"
                                                        multiple="multiple" size="4">
                                                    </select>
                                                </div>
                                                <div class="col-md-2" style="text-align:center">
                                                    <div>
                                                        <input type="button" class="btn-add-material pasar izq btn btn-success" value="Agregar »">
                                                    </div>
                                                    <div>  
                                                        <input type="button" class="btn-remove-material quitar der btn btn-default" value="« Eliminar">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class=" form-control" name="destino" id="destino"
                                                        multiple="multiple" size="4"></select>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-top:20px;">
                                                <div class="col-md-3 offset-md-5">
                                                    <label for="branch"><strong>¿Posee prioridad?</strong></label>
                                                    <div class="input-group " id="priority_add">

                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <!-- this &nbsp; inserts whitespaces to center the text -->

                                                        <span class="radio">
                                                            <label>Sí</label>
                                                            <label>
                                                                <input id="priority_add1" type="radio" value="1"
                                                                    class="radiobox" name="priority_add">
                                                            </label>

                                                            <label>
                                                                <label style="margin-left:20px;">No</label>
                                                                <input id="priority_add0" type="radio" value="0"
                                                                    class="radiobox" name="priority_add" checked>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                                                <a class='btn btn-success btn-block' onclick="addWorkToTable();"
                                                    type='submit'>Agregar a la orden</a>
                                            </div>
                                            <div class="col-md-4" style="margin-top:5px; ">
                                                <a class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</a>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- The Modal Contact Information-->
                            <div class="modal fade" id="modalEditWork">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Trabajo</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="col-md-5">
                                                    <label for="date-field"><strong>Fecha de entrega</strong></label>
                                                    <div class="input-group date" id="datetimepicker5"
                                                        data-target-input="nearest">
                                                        <input id="dateInput_edit" type="text" name="date"
                                                            class="form-control datetimepicker-input"
                                                            data-target="#datetimepicker5" onkeydown="return false">
                                                        <div class="input-group-append" data-target="#datetimepicker5"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><span
                                                                    class="glyphicon glyphicon-calendar"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <input type="text" id="searchProductInput_Edit"
                                                onkeyup="searchProductEdit()">
                                            <div class="row justify-content-center">
                                                <div class="col-md-8 align-self-center">
                                                    <label for="product_branch_edit"><strong>Producto</strong></label>
                                                    <select class="form-control" id="product_branch_edit"
                                                        name="product_branch_edit" size="4">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center" style="margin-top:20px;">
                                                <div class="col-md-10">
                                                    <label for="observation_edit"><strong>Observaciones
                                                            Adicionales</strong></label>
                                                    <textarea class="form-control" type="text"
                                                        onkeyup="countCharsEditModal(this);" value="" rows="5"
                                                        id="observation_edit" name="observation_edit"></textarea>
                                                    <p id="charNumEdit">0 caracteres</p>
                                                </div>
                                            </div>
                                            <input type="text" id="searchOriginInputEdit" onkeyup="searchOriginEdit()">
                                            <div class="row justify-content-center">
                                                <div class="col-md-4">
                                                    <select multiple class="form-control" name="origen_edit"
                                                        id="origen_edit" multiple="multiple" size="4">
                                                    </select>
                                                </div>
                                                <div class="col-md-1" style="text-align:center">
                                                    <input type="button"
                                                        class="btn-add-material pasar izq btn btn-success" value="+">
                                                    <input type="button"
                                                        class="btn-remove-material quitar der btn btn-default"
                                                        value="-">
                                                </div>
                                                <div class="col-md-4">
                                                    <select class=" form-control" name="destino_edit" id="destino_edit"
                                                        multiple="multiple" size="4"></select>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:20px;">
                                                <div class="col-md-3 offset-md-1">
                                                    <label for="branch"><strong>¿Posee prioridad?</strong></label>
                                                    <div class="input-group " id="priority_edit">

                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <!-- this &nbsp; inserts whitespaces to center the text -->

                                                        <span class="radio">
                                                            <label>Sí</label>
                                                            <label>
                                                                <input id="priority_edit1" type="radio" value="1"
                                                                    class="radiobox" name="priority_edit">
                                                            </label>

                                                            <label>
                                                                <label style="margin-left:20px;">No</label>
                                                                <input id="priority_edit0" type="radio" value="0"
                                                                    class="radiobox" name="priority_edit" checked>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                                                <a class='btn btn-success btn-block' onclick="updateWork();"
                                                    type='submit'>Actualizar información</a>
                                            </div>
                                            <div class="col-md-4" style="margin-top:5px; ">
                                                <a class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</a>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----------------------------------------------------------------- END TAB 2 ------------------------------------------->


                        <!-- <div style="overflow:auto;">
                                    <div style="float:right;">
                                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                  </div> -->

                        <!-- Circles which indicates the steps of the form: -->
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                                <!-- next button, the "Siguiente" text is added at the js -->
                                <a id="nextBtn" onclick="nextPrev(1);" class='btn btn-success btn-block'></a>
                            </div>
                            <div class="col-md-4" style="margin-top:5px; ">
                                <a class="btn btn btn-block" id="prevBtn" onclick="nextPrev(-1)">Regresar</a>
                            </div>
                        </div>
                        <!--<a style="margin-top: 5px;" href="/especialistas" class = 'btn btn-primary'><i class="fa fa-home"></i>Ver Especialistas</a>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- The modal of the qwner clients of the order-->
<div class="modal fade" id="table-clients">
    <div class="modal-dialog" style="min-width:80%" >
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Clientes</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="table-responsive" style="text-align:center">
                <div id="tableDiv" style="display:">
                    <table style="overflow: visible !important;"
                                class="table table-striped table-sm table-bordered table-drop table-condensed table-hover compact order-column"
                                id="tableClients">
                        <thead>
                            <th class="text-center" style="width: 40px">Número</th>
                            <th class="text-center" style="width: 160px">Cédula</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center" style="width: 140px">Teléfono</th>
                            
                            <th class="text-center" style="width: 110px">Opción</th>
                        </thead>

                        <tbody id="tableBody">

                        </tbody>
                    </table>
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

<script>
    /*$('#datepicker').datepicker({
  uiLibrary: 'bootstrap4',
  locale: 'es-es',
});*/
</script>
<script src="{{asset('/js/create_works_modal.js')}}"></script>
<script src="{{asset('/js/works_table_create.js')}}"></script>

@endsection