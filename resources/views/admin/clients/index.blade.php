@extends('masterAdmin')

@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel" >
       <p class="title-panel">Clientes</p>
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
               @if(session('message'))
               <div class="alert alert-success alert-dismissible" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   {{@session('message')}}
               </div>
               @endif
               @if(session('error'))
               <div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   {{@session('error')}}
               </div>
               @endif
           @if($clients->count())
           <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover" id="tablaDatos">
               
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
                       <?php $tel = str_split($client->number); $numeroTel = $tel[0] .  $tel[1] .  $tel[2] .  $tel[3] . ' - ' .  $tel[4] .  $tel[5] .  $tel[6] .  $tel[7]?>
                           <tr>
                               <td class="text-center">{{$client->identification}}</td>
                               <td class="text-center"><strong>{{$client->name}}</strong></td>
                               <td class="text-center">{{$client->email}}</td>
                               <td class="text-center">{{$numeroTel}}</td>
                               @if($client->active_flag == 1)
                               <td class="text-center">Activo</td>
                               @else
                               <td class="text-center">Desactivo</td>
                               @endif
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
               <h3 class="text-center alert alert-info">No hay nada para mostrar</h3>
           @endif

       </div>
       </div>
   </div> 
   </div> 
   </section>
   </div>
   <script src="{{asset('js/lenguajeTabla.js')}}"></script>
@endsection

