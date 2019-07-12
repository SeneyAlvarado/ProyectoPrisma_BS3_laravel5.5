@extends('masterAdmin')
@section('contenido_Admin')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
    <div class="card" style="margin-left:15px; margin-right:15px;">
    <div class="card-header"><h5 style="text-align:center; ">Acceso a Trabajos</h5></div>
    </div>
            <div style="margin-top:20px;" class="container-fluid">
           <div class="">
            @if($state_user_types->count())
           <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
                   <thead>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Tipo de Usuario</th>
                        <th class="text-center">Notificaciones</th> 
                        <th class="text-center">Ver estado</th> 
                        <th class="text-center">Modificar estado</th> 
                        <th class="text-center">Opciones</th>                         
                   </thead>

                   <tbody>
                       @foreach($state_user_types as $state_user_type)
                           <tr>
                               <td class="text-center">{{$state_user_type->state_name}}</td>
                               <td class="text-center">{{$state_user_type->user_type_name}}</td>
                               @if($state_user_type->state_notification == 1)
                               <td class="text-center">Activadas</td>
                               @else
                               <td class="text-center">Desactivadas</td>
                               @endif
                               @if($state_user_type->view_state == 1)
                               <td class="text-center">Permitido</td>
                               @else
                               <td class="text-center">No permitido</td>
                               @endif
                               @if($state_user_type->edit_state == 1)
                               <td class="text-center">Permitido</td>
                               @else
                               <td class="text-center">No Permitido</td>
                               @endif
                               
                               <td class="text-center">
                                    <a class="btn btn-warning style-btn-edit btn-size btn-sm" href="{{ route('state_user_types.edit', $state_user_type->id) }}">Editar</a>
                                   <form style="display:inline" action="{{ route('state_user_types.deactivate', $state_user_type->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar el acceso del rol {{$state_user_type->user_type_name}} a los trabajos con estado {{$state_user_type->state_name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn style-btn-delete btn-danger btn-size btn-sm">Eliminar</button>
                                   </form>
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

<script src="{{asset('/js/lenguajeTabla.js')}}"></script>
@endsection