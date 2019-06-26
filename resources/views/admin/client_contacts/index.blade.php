@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div style="padding:10px;">
    <div class="card margin-bottom-card" >
    <div class="card-header"><h5 style="text-align:center; ">Contactos</h5></div>
    </div>
            
           <div class="">
            @if($contacts->count())
           <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
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
                                <form style="display:inline" action="{{ route('client_contacts.destroy', $contact->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar el contacto {{$contact->contact_name}}?');">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"  class="btn btn-success style-btn-success btn-size btn-sm">Eliminar</button>
                                </form>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>

           </div>
               
           @else
           <a class="btn btn-success style-btn-registry" href="{{ route('client_contacts.create', $id) }}" style="margin-bottom: 10px; ">Agregar </a>
               <h3 class="text-center alert alert-info header-gris">No hay nada para mostrar</h3>
           @endif
     

<script src="{{asset('js/lenguajeTabla.js')}}"></script>

@endsection