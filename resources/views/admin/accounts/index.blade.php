@extends('masterPrueba3')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">

<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel" >
       <p class="title-panel" style="font-size:20px;">Cuentas</p>
   </div>
   <div class="panel-body">
   <div class="content-c w3-container mobile">
           <div> 
           <a  class="btn btn-success style-btn-registry" href="{{ route('create_account_admin') }} " style="margin-bottom: 10px; ">Registrar </a>
           
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
                               <td class="text-center"><strong>{{$userName}}</strong></td>
                               <td class="text-center">{{$user->email}}</td>
                               <td class="text-center">{{$user->user_type_name}}</td>
                               <td class="text-center">{{$user->branch_name}}</td>
                               @if($user->active_flag == 1)
                               <td class="text-center">Activo</td>
                               @else
                               <td class="text-center">Desactivo</td>
                               @endif
                               <td class="text-center">
                              
                                    <a class="btn btn-warning style-btn-edit" href=""><span class="glyphicon glyphicon-edit"></span></a>
                                   @if($user->active_flag == 1)
                                   <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el cliente {{$user->name}} {{$user->lastname}} {{$user->second_lastname}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  style-btn-delete btn-danger"><span class="glyphicon glyphicon-ban-circle"></span></button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar el cliente {{$user->name}} {{$user->lastname}} {{$user->second_lastname}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  btn-primary">&nbsp&nbsp&nbspActivar&nbsp&nbsp&nbsp</button>
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
   <script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection























