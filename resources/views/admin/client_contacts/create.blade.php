@extends('masterAdmin')
@section('contenido_Admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">
    <div class="card margin-bottom-card">
        <div class="card-header">
            <h5 style="text-align:center; ">Contactos</h5>
        </div>
    </div>

    <div class="">
        @if($clients->count())
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
                    @foreach($clients as $client)
                    <tr>
                        <td class="text-center">{{$client->id}}</td>
                        <td class="text-center">{{$client->identification}}</td>
                        <td class="text-center">{{$client->name}}</td>
                        <td class="text-center">{{$client->email}}</td>
                        <td class="text-center">{{$client->phone}}</td>
                        <td class="text-center">
                            <a class="btn btn-success style-btn-success btn-sm"
                                href="{{ route('client_contacts.store',  [$client->owner_id, $client->id]) }}"
                                style=" width:90px;"
                                onclick="return confirm('¿Desea agregar a {{$client-> name}} a la lista de contactos de {{$client->owner_name}}?');">Seleccionar
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        @else
        <h3 class="text-center alert alert-info header-gris">No hay contactos para mostar</h3>
        @endif

        <script src="{{asset('/js/Client_contacts/client_contact_table_create.js')}}"></script>

        @endsection