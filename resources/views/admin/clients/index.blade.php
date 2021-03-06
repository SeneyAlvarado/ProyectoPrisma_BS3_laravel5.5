@extends('masterAdmin')
@section('contenido_Admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">
    <div class="card margin-bottom-card">
        <h5 class="card-header" style="text-align:center">Clientes</h5>
        </div>
            <div class="">
            
                @if($clients->count())
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">

                        <thead>
                            <th class="text-center">Cédula</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado cliente</th>
                            <th class="text-center">Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                            <?php

                            $clientName = $client->name;
                            if ($client->type == 1) {
                                $clientName = $clientName . ' ' . $client->lastname . ' ' . $client->second_lastname;
                            }

                            $numeroTel = '';
                            if ($client->phones->count()) {
                                foreach ($client->phones as $phone) {
                                    $numeroTel = $phone->number;
                                }
                            } else {
                                $numeroTel = 'No posee';
                            }

                            $clientEmail = '';
                            if ($client->emails->count()) {
                                foreach ($client->emails as $email) {
                                    $clientEmail = $clientEmail . '  ' . $email->email;
                                }
                            } else {
                                $clientEmail = 'No posee';
                            }

                            $identification = $client->identification;
                            if (empty($identification)) {
                                $identification = "-----";
                            }
                            ?>
                            <tr>
                                <td class="text-center">{{$identification}}</td>
                                <td class="text-center"><strong>{{$clientName}}</strong></td>
                                <td class="text-center">{{$clientEmail}}</td>
                                <td class="text-center">{{$numeroTel}}</td>
                                @if($client->active_flag == 1)
                                <td class="text-center">Activo</td>
                                @else
                                <td class="text-center">Desactivo</td>
                                @endif
                                <td class="text-center">
                                    <a class="btn btn-warning style-btn-edit btn-sm" style="width:78px;" href="{{ route('client_contacts.index', [$client->id]) }}">Contactos</a>
                                    <a class="btn btn-warning style-btn-edit btn-sm" style="width:50px;" href="{{ route('clients.edit', [$client->id]) }}">Editar</a>
                                    @if($client->active_flag == 1)
                                    <form style="display:inline" action="{{ route('clients.deactivate', $client->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea desactivar la cuenta de {{$clientName}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  style-btn-delete btn-danger btn-sm">Desactivar</button>
                                    </form>
                                    @else
                                    <form style="display:inline" action="{{ route('clients.activate', $client->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea activar la cuenta de {{$clientName}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-success style-btn-success btn-sm">Activar</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <a class="btn btn-success style-btn-registry" href="{{ url('clients.create') }} " style="margin-bottom: 10px; ">Registrar </a>  
                <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
                @endif

            </div>
     
    </div>
</div>

<script src="{{asset('/js/lenguajeTabla.js')}}"></script>
@endsection