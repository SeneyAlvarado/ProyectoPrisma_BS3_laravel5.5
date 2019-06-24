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
                    <form method='POST' action='{{ route("orders.store") }}'
                        onsubmit="return check_clients_branch_select(this)">
                        <input type='hidden' name='_token' value='{{Session::token()}}'>
                        <input type='hidden' id='hiddenDateCR'
                            value='{{\Carbon\Carbon::now('America/Costa_Rica')->addDay(7)->format('d/m/Y')}}'>
                        <input type='hidden' id='editRow' value=''>


                        <div class="tab">
                            <div class="row justify-content-center">
                                
                            </div>
                            <div class="row " style=" margin-bottom:10px;">
                                <div class="col-md-3 offset-md-2">
                                <label for="user_name"><strong>Buscar cliente</strong></label>
                                    <input type="text" placeholder="Buscar cliente" class="form-control" id="searchOwnerInput" onkeyup="searchOwner()">
                                </div>
                                <div class="col-md-3 offset-md-2">
                                    <label for="user_name"><strong>Número Cotización</strong></label>
                                    <input id="user_name" placeholder="# Cotización" class="form-control"
                                        name="user_name" type='text' pattern="[0-9]*"
                                        title="No se permite ingresar letras en este campo">
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
                                    <input type="text" class="form-control"  placeholder="Buscar contacto" id="searchContactInput" onkeyup="searchContact()">
                                </div>
                            </div>    
                            <div class="row justify-content-center">

                                <div class="col-md-8 align-self-center">
                                    
                                    <select size="4" class="form-control" id="selectList_contact" name="contact_client">
                                    </select>
                                </div>
                            </div>

                            <!--
                            <div class="row justify-content-center" style="margin-top:20px;">
                                <div class="col-md-4 " >
                                <label for="name"><strong>Detalle de orden</strong></label>
                                <input id="order_detail" placeholder="Detalle de la órden" class="form-control" name="order_detail" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0-9 \s]{2,48}" title="" required>
                            </div> 
                                <div class="col-md-4">
                                    <label for="branch"><strong>Sucursal</strong></label>
                                    <select id="dropBranch" name="dropBranch" class="form-control"></select>
                                </div> 
                        </div>-->

                            <!-- <div class="row justify-content-center">
                            <div class="col-md-4 offset-md-5">
                            @ //if ($errors->has('delibery_date'))
                            <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('delibery_date') }}</strong>
                            </span>
                            @//endif
                            </div> -->
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
                                                <th class="text-center">Adelanto de pago</th>
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
                                                <label for="avatar"><strong>Adjuntar archivo</strong></label>
                                                <input id="avatar" class="form-control" name="avatar" type="file">
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
                                            <input type="text" id="searchProductInput" onkeyup="searchProduct()">

                                            <div class="row justify-content-center">
                                                <div class="col-md-8 align-self-center">
                                                    <label for="product_branch"><strong>Producto</strong></label>
                                                    <select size="4" class="form-control" id="product_branch"
                                                        name="product_branch">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center" style="margin-top:20px;">
                                                <div class="col-md-10">
                                                    <label for="observation_add"><strong>Observaciones
                                                            Adicionales</strong></label>
                                                    <textarea class="form-control" onkeyup="countCharsAddModal(this);"
                                                        value="" rows="5" id="observation_add"
                                                        name="observation_add"></textarea>
                                                    <p id="charNumAdd">0 caracteres</p>
                                                </div>
                                            </div>
                                            <input type="text" id="searchOriginInputAdd" onkeyup="searchOriginAdd()">
                                            <div class="row justify-content-center">
                                                <div class="col-md-4">
                                                    <select multiple class="form-control" name="origen" id="origen"
                                                        multiple="multiple" size="4">
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
                                                    <select class=" form-control" name="destino" id="destino"
                                                        multiple="multiple" size="4"></select>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-top:20px;">
                                                <div class="col-md-4 offset-md-2">
                                                    <label for="branch"><strong>¿Posee adelanto
                                                            económico?</strong></label>
                                                    <div class="input-group " id="advance_payment_add">

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <!-- this &nbsp; inserts whitespaces to center the text -->

                                                        <span class="radio">
                                                            <label>Sí</label>
                                                            <label>
                                                                <input id="payment_add1" type="radio" value="1"
                                                                    class="radiobox" name="advance_payment_add">
                                                            </label>

                                                            <label>
                                                                <label style="margin-left:20px;">No</label>
                                                                <input id="payment_add0" type="radio" value="0"
                                                                    class="radiobox" name="advance_payment_add" checked>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 offset-md-1">
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
                                                <div class="col-md-4 offset-md-2">
                                                    <label for="branch"><strong>¿Posee adelanto
                                                            económico?</strong></label>
                                                    <div class="input-group " id="advance_payment_edit">

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <!-- this &nbsp; inserts whitespaces to center the text -->

                                                        <span class="radio">
                                                            <label>Sí</label>
                                                            <label>
                                                                <input id="payment_edit1" type="radio" value="1"
                                                                    class="radiobox" name="advance_payment_edit">
                                                            </label>

                                                            <label>
                                                                <label style="margin-left:20px;">No</label>
                                                                <input id="payment_edit0" type="radio" value="0"
                                                                    class="radiobox" name="advance_payment_edit"
                                                                    checked>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
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
                                <a id="nextBtn" name="xD" onclick="nextPrev(1)" class='btn btn-success btn-block'></a>
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
<script>
    /*$('#datepicker').datepicker({
  uiLibrary: 'bootstrap4',
  locale: 'es-es',
});*/
</script>
<script src="{{asset('/js/create_works_modal.js')}}"></script>
<script src="{{asset('/js/works_table_create.js')}}"></script>

@endsection