@extends('masterAdmin')
@section('contenido_Admin')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="{{asset('js/load_contacts.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/loader.css')}}">

<div style="padding:10px;">
  
    <div class="card margin-bottom-card">
        <div class="card-header">
            <h5 style="text-align:center; ">Contactos</h5>
        </div>
    </div>
    <input type='hidden' id='clientID' value='{{$id}}'>

    <div class="">

    <div id="loader" style="display:none" class="row justify-content-center">
        <div class="loader" ></div>
    </div>
        @if($contacts->count())
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover compact order-column"
                id="tablaDatos">
                <thead>
                    <th class="text-center">N°</th>
                    <th class="text-center">Cédula</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Opciones</th>
                </thead>

                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td class="text-center">{{$contact->id}}</td>
                        <td class="text-center">{{$contact->identification}}</td>
                        <td class="text-center">{{$contact->contact_name}}</td>
                        <td class="text-center">{{$contact->email}}</td>
                        <td class="text-center">{{$contact->phone}}</td>
                        <td class="text-center">
                      
                            <button class="btn btn-success style-btn-registry btn-sm" onClick="deleteContact({{$contact->id}}); return confirm('¿Desea eliminar el contacto {{$contact->contact_name}}?')"
                            >Eliminar </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        @else
        <button class="btn btn-success style-btn-registry" onClick="listContactsTable({{$id}});"
            style="margin-bottom: 10px; ">Agregar </button>
        <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
        @endif

         <!-- The modal of the qwner clients of the order-->
<div class="modal fade" id="table-clients">
    <div class="modal-dialog" style="min-width:90%">
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
                            id="tableContacts">
                            <thead>
                                <th class="text-center" style="width: 40px">N°</th>
                                <th class="text-center" style="width: 160px">Cédula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center" style="width: 240px">Correo</th>
                                <th class="text-center" style="width: 140px">Teléfono</th>
                                <th class="text-center" style="width: 110px">Opciones</th>
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
        <script src="{{asset('/js/client_contact_table_index.js')}}"></script>
        @endsection

       