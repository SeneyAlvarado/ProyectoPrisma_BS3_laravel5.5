@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">

    <div class="card">
        <h5 class="card-header" style="text-align:center">Cuentas</h5>
        <div class="card-body">
            <div class="container-fluid">
                <div>
                    <a class="btn btn-success style-btn-registry" href="{{ route('create_account_admin') }} " style="margin-bottom: 10px; ">Crear </a>

                </div>
                @if($users->count())
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">

                        <thead>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Sucursal</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Opciones</th>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                            <?php
                            $userName = $user->name  . ' ' . $user->lastname;
                            ?>
                            <tr>
                                <td class="text-center">{{$userName}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">{{$user->user_type_name}}</td>
                                <td class="text-center">{{$user->branch_name}}</td>
                                @if($user->active_flag == 1)
                                <td class="text-center">Activo</td>
                                @else
                                <td class="text-center">Desactivo</td>
                                @endif
                                <td class="text-center">

                                    <a class="btn btn-warning style-btn-edit btn-size" href="{{ route('admin_edit_accounts', $user->id) }}">Editar</a>
                                    @if($user->active_flag == 1)
                                    <form style="display:inline" action="{{ route('admin_desactivate_accounts', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar la cuenta de {{$user->name}} {{$user->lastname}} {{$user->second_lastname}}?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn  style-btn-delete btn-danger btn-size">Desactivar</button>
                                    </form>
                                    @else
                                    <form style="display:inline" action="{{ route('admin_activate_accounts', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar la cuenta de {{$user->name}} {{$user->lastname}} {{$user->second_lastname}}?');">
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
                <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection