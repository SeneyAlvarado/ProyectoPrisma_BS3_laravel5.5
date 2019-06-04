@extends('masterAdmin')

@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div class="panel panel-primary border-panel">
    <div class="panel-heading  bg-color-panel">
       <p style="text-align: center; font-size: 3vh;">Pacientes</p>
   </div>
   <div class="panel-body">
       <section class="">
       <div class="content-c w3-container mobile">
           <div> 
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
                       <th class="text-center">Estado Cuenta</th>    
                       <th class="text-center">Opciones</th>                         
                   </thead>

                   <tbody>
                       @foreach($clients as $client)
                       <?php $nombre = $client->nombre . " " . $client->primer_apellido_paciente . " " . $client->segundo_apellido_paciente?>
                       <?php $tel = str_split($client->telefono); $numeroTel = $tel[0] .  $tel[1] .  $tel[2] .  $tel[3] . ' - ' .  $tel[4] .  $tel[5] .  $tel[6] .  $tel[7]?>
                           <tr>
                               <td class="text-center"><strong>{{$client->cedula_paciente}}</strong></td>
                               <td class="text-center"><strong>{{$nombre}}</strong></td>
                               <td class="text-center">{{$client->correo}}</td>
                               <td class="text-center">{{$numeroTel}}</td>
                               @if($client->active_flag == 1)
                               <td class="text-center">Activa</td>
                               @else
                               <td class="text-center">Desactiva</td>
                               @endif
                               <td class="text-center"><a class="btn btn-warning" href="{{ route('pacientes.editRoot', $client->id) }}">Editar</a>
                                   @if($client->active_flag == 1)
                                   <form style="display:inline" action="{{ route('pacientes.destroy', $client->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar el paciente {{$client->nombre}} {{$client->primer_apellido_paciente}} {{$client->segundo_apellido_paciente}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  btn-danger">Desactivar</button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="{{ route('pacientes.activar', $client->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar el paciente {{$client->nombre}} {{$client->primer_apellido_paciente}} {{$client->segundo_apellido_paciente}}?');">
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
               <h3 class="text-center alert alert-info">No hay nada para mostrar</h3>
           @endif

       </div>
       </div>
   </div> 
   </div> 
   </section>
   </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($clients->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Type</th> <th>Name</th> <th>Address</th> <th>Active_flag</th> <th>Identification</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td class="text-center"><strong>{{$client->id}}</strong></td>

                                <td>{{$client->type}}</td> <td>{{$client->name}}</td> <td>{{$client->address}}</td> <td>{{$client->active_flag}}</td> <td>{{$client->identification}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('', $client->id) }}">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('', $client->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $clients->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection