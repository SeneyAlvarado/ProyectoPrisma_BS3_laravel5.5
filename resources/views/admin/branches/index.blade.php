@extends('masterAdmin')
@section('contenido_Admin')
<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Cuentas</h5>
        <div class="card-body">

        <button type="button" class="btn btn-info" style="background-color:#96183a; border:none; margin-bottom:10px;" data-toggle="modal" data-target="#myModal">+</button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar sucursal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <form action="{{ route('branch.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row justify-content-center">
                    <div class="col-md-8">
                    <label for="name"><strong>Nombre de sucursal</strong></label>
                        <input placeholder="Nombre" class="nombre margin-lft form-control" name = "name" type="text" id="nombre_recinto" pattern="[a-zA-Z áéíóúÁÉÍÓÚñÑ]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    </div>
                    <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button  style="margin-top:15px;" class = 'style-btn-success btn-block margin-button btn btn-info' type ='submit'>Agregar</button>
                    </div>
                    <div class="col-md-4">    
                        <button  style="margin-left:1px; margin-top:15px;" class = 'btn-block margin-button btn btn-default' data-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
            </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
           <div class="">
            @if($branches->count())
           <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover compact order-column" id="tablaDatos">
                   <thead>
                        <th class="text-center">Número</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Estado</th> 
                        <th class="text-center">Opciones</th>                         
                   </thead>

                   <tbody>
                       <?php $count = 1;?>
                       @foreach($branches as $branch)
                       
                           <tr>
                               <td class="text-center">{{$count}}</td>
                               <?php $count = $count + 1;?>
                               <td class="text-center">{{$branch->name}}</td>
                               @if($branch->active_flag == 1)
                               <td class="text-center">Activa</td>
                               @else
                               <td class="text-center">Desactiva</td>
                               @endif
                               <td class="text-center">
                                    <button type="button" class="btn btn-info style-btn-edit btn-size" data-toggle="modal" onCLick="myFunction('{{$branch->name}}', '{{$branch->id}}')">Editar</button>
                                    
                                   @if($branch->active_flag == 1)
                                   <form style="display:inline" action="{{ route('branch.desactivate', $branch->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar la sucursal de {{$branch->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  style-btn-delete btn-secundary btn-size">Desactivar</button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="{{ route('branch.activate', $branch->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar la sucursal de {{$branch->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit"  class="btn btn-secundary style-btn-success btn-size">Activar</button>
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

<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar sucursal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <form method = 'POST' action='{{ route("branch.update") }}'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="">
      
                    <div class="row justify-content-center">
                    <div class="col-md-8">
                    <label for="name"><strong>Nombre de sucursal</strong></label>
                    <input id="name-field" value="" class="form-control" name = "name" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    
                    </div>
                    <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button  style="margin-top:15px;" id ="update" class = 'style-btn-success btn-block margin-button btn btn-info' type ='submit'>Actualizar</button>
                    </div>
                    <div class="col-md-4">    
                        <button  style="margin-left:1px; margin-top:15px;" class = 'btn-block margin-button btn btn-default' data-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
            </form>
        
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
         
        </div>
        
      </div>
    </div>
  </div>
<script src="{{asset('js/lenguajeTabla.js')}}"></script>

<script>
function myFunction(name, id) {
    $(".name").html(name);
    $("input[name=id]").val(id);
    $("input[name=name]").val(name);
    $("#editModal").modal('show');
}
</script>

@endsection