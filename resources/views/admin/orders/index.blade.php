@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Órdenes</h5>
        <div class="card-body">
            <div class="container-fluid">
            <div> 
                <a class="btn btn-success style-btn-registry" href="" style="margin-bottom: 10px; ">+</a>
            </div>
           <div class="">
            @if($orders->count())
           <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
                   <thead>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Cotización</th>
                        <th class="text-center">Cliente</th> 
                        <th class="text-center">Entrega</th>
                        <th class="text-center">Estado</th> 
                        <th class="text-center">Contacto</th> 
                        <th class="text-center">Opciones</th>                         
                   </thead>

                   <tbody>
                       @foreach($orders as $order)
                           <tr>
                               <td class="text-center">{{$order->id}}</td>
                               <td class="text-center">{{$order->quotation_number}}</td>
                               <td class="text-center"><a href="">{{$order->name}}</a></td>
                               <td class="text-center">{{$order->approximate_date}}</td>
                               <td class="text-center">
                               <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                    </div>
                                </td>
                               <td class="text-center"><a href="{{ route('contact.show', $order->client_contact) }}">Información</a></td>
                               
                               <td class="text-center">
                                   
                                   <a class="btn btn-warning" style="background-color:#e0e0e0; border:0px;" href=""><span class="glyphicon glyphicon-folder-open"></a>
                                    <a class="btn btn-warning" href="" style="background-color:#e0e0e0; border:0px;"><span class="glyphicon glyphicon-pencil"></span></a>
                                   @if($order->active_flag == 1)
                                   <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea cancelar la orden de {{$order->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn style-btn-delete btn-danger btn-size "><span class="glyphicon glyphicon-ban-circle"></span></button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar la orden de {{$order->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit"  class="btn btn-success style-btn-success btn-size">Activar</button>
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