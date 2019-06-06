@extends('masterAdmin')

@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel" >
       <p class="title-panel" style="font-size:20px;">Cuentas</p>
   </div>
   <div class="panel-body">
       <section class="">
       <div class="content-c w3-container mobile">
           <div> 
           <a  class="btn btn-success style-btn-registry"  style="margin-left: 15px; ">Registrar </a>
           
       </div>
   </div>

   <div class="panel-heading">
       <div class="">
       <div class="">
           @if($clients->count())
           <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
               
                   <thead>
                       <th class="text-center">Nombre</th>
                       <th class="text-center">Correo</th>
                       <th class="text-center">Tipo</th> 
                       <th class="text-center">Estado</th> 
                       <th class="text-center">Sucursal</th>
                       <th class="text-center">Opciones</th>                         
                   </thead>

                   <tbody>
                       @foreach($users as $user)
                        <?php 
                        $userName = $user->name . ' ' . $user->lastname . ' ' . $user->second_lastname;
                        ?>
                           <tr>
                               <td class="text-center"><strong>{{$userName}}</strong></td>
                               <td class="text-center">{{$user.email}}</td>
                               <td class="text-center">{{$user.user_type_name}}</td>
                               @if($client->active_flag == 1)
                               <td class="text-center">Activo</td>
                               @else
                               <td class="text-center">Desactivo</td>
                               @
                               <td class="text-center">{{$user.branch_name}}</td>
                               <td class="text-center">
                               <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" style="background-color:#ABABAB !important; border:0px;" type="button" data-toggle="dropdown">
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu" style="text-align:center;">
                                    <a class="btn btn-warning style-btn-edit" href="">Editar</a>
                                   @if($client->active_flag == 1)
                                   <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el cliente {{$client->name}} {{$client->lastname}} {{$client->second_lastname}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  style-btn-delete btn-danger">Desactivar</button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar el cliente {{$client->name}} {{$client->lastname}} {{$client->second_lastname}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  btn-primary">&nbsp&nbsp&nbspActivar&nbsp&nbsp&nbsp</button>
                                   </form>
                                   @endif
                                    </ul>
                                    
                                </div>
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
   </section>
   </div>
   <script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection