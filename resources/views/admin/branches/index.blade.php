@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/lenguajeTabla.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Cuentas</h5>
        <div class="card-body">

        <button style="margin-bottom:15px;" id="mybutton" class = ' margin-button-agregar btn btn-success mobile' onclick="myFunction()">Agregar Sucursal</button>
            <form action="{{ route('branch.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div id="myDIV" style="display: none; margin-bottom:15px;">
                    <div class="row " id="agregar">
                    <div>
                        <input placeholder="Nombre" class="nombre margin-lft form-control" name = "descripcion" type="text" id="nombre_recinto" pattern="[a-zA-Z áéíóúÁÉÍÓÚñÑ]{2,48}" title="No se permiten números en este campo"> 
                    </div>
                    <div>
                        <button  style="margin-left:10px;" class = 'margin-button btn btn-success mobile' type ='submit'>Agregar</button>
                    </div>
                    </div>
                </div>
            </form>
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
                       @foreach($branches as $branch)
                       <?php $count = 1;?>
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
                              
                                    <a class="btn btn-warning style-btn-edit btn-size" href="{{ route('branch.edit', $branch->id) }}">Editar</a>
                                   @if($branch->active_flag == 1)
                                   <form style="display:inline" action="{{ route('branch.desactivate', $branch->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea desactivar la sucursal de {{$branch->name}}?');">
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn  style-btn-delete btn-danger btn-size">Desactivar</button>
                                   </form>
                                   @else
                                   <form style="display:inline" action="{{ route('branch.activate', $branch->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Desea activar la sucursal de {{$branch->name}}?');">
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
</div>
<script src="{{asset('js/lenguajeTabla.js')}}"></script>

<script>
function myFunction() {
	var x = document.getElementById("myDIV");
	var y = document.getElementById("mybutton");
	var button = document.getElementById("mybutton");
	
    if (x.style.display === "none") {
		y.style.display ="none";
        x.style.display = "block";
        boton.setBackgroundColor(0xFF00FF00);
    } else {

        x.style.display = "none";
    }
}
</script>
@endsection