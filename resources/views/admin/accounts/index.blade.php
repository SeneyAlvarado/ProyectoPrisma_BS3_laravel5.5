@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/multiple-materials-select.css')}}">
<script src="{{asset('js/multiple-materials-select.js')}}"></script>
<div style="padding:10px;">
    <div class="card margin-bottom-card" >
    <div class="card-header"><h5 style="text-align:center; ">Cuentas</h5></div>
    </div>
            
           <div class="">
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
                                    <a class="btn btn-warning style-btn-edit btn-size btn-sm" href="{{ route('user.edit', $user->id) }}">Editar</a>
                                   @if($user->active_flag == 1)
                                   <form style="display:inline" action="{{ route('user.desactivate', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar la cuenta de {{$user->name}} {{$user->lastname}} {{$user->second_lastname}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn style-btn-delete btn-danger btn-size btn-sm">Desactivar</button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="{{ route('user.activate', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar la cuenta de {{$user->name}} {{$user->lastname}} {{$user->second_lastname}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit"  class="btn btn-success style-btn-success btn-size btn-sm">Activar</button>
                                   </form>
                                   @endif
                                 
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>

           </div>

<form action="" method="post" id="formulario">
<div class="row justify-content-center">
    <div class="col-md-4">
        <select multiple class="form-control" name="origen[]" id="origen" multiple="multiple" size="4">
        <option value="1">Opción 1</option>
        <option value="2">Opción 2</option>
        <option value="3">Opción 3</option>
        <option value="4">Opción 4</option>
        <option value="5">Opción 5</option>
        <option value="6">Opción 6</option>
        <option value="7">Opción 7</option>
        <option value="8">Opción 8</option>
        </select>
    </div>
    <div class="col-md-1" style="text-align:center">
        <input type="button" class="btn-add-material pasar izq btn btn-success" value="+">
        <input type="button" class="btn-remove-material quitar der btn btn-default" value="-">
    </div>
    <div class="col-md-4">
        <select class=" form-control" name="destino[]" id="destino" multiple="multiple" size="4"></select>
    </div>
</div>
</form>
               
           @else
               <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
           @endif
     

<script src="{{asset('js/lenguajeTabla.js')}}"></script>

@endsection