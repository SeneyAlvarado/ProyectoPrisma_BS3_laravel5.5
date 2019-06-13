@extends('masterPrueba3')

@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-plus"></i> Productos </h1>
</div>
@endsection

@section('contenido_Admin')
@include('error')
<script src="{{asset('js/load_branches_admin.js')}}"></script>

<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel">
        <p class="title-panel" style="font-size:20px;">Crear Producto</p>
    </div>
    <div class="panel-body">
        <section class="">
            <div class="">


                <form action="{{ route('products.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div>
                        <div class="col-md-7 col-md-offset-2" style="margin-top:10px;">
                            <label for="name"><strong>Nombre</strong></label>
                            <input id="name" placeholder="Nombre" class="form-control" name="name" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo">
                        </div>
                    </div>
                    <div class="col-md-7 col-md-offset-2"><hr></div>
                 
                    <div>
                        <div class="col-md-7 col-md-offset-2">
                            <label for="description"><strong>Descripcion</strong></label>
                            <textarea class="form-control" style="resize:none;" name="description" id="description-field" rows="5" cols="50"></textarea>

                            <!-- <input id="description" placeholder="Descripci[on" class="form-control" name="description" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required> -->
                        </div>
                    </div>
                    <div class="col-md-7 col-md-offset-2"><hr></div>
                   
                    <div class="col-md-4  col-md-offset-2" style="margin-top:10px;">
                        <label for="active_flag"><strong>Active Flag</strong></label>
                        <br>
                        <input type="radio" name="active_flag" value="1" checked> Activo<br>
                        <input type="radio" name="flactive_flagag" value="0"> Desactivado<br>
                    </div>
                    <div class="col-md-7 col-md-offset-2"><hr></div>
                   
                    <div class="col-md-7 col-md-offset-2 " style="margin-top:10px;">
                        <label for="branch"><strong>Branch</strong></label>
                        <br>

                        <select class="form-control" name="branch_id" id="branch_id">
                            @if($branches->count())

                            @foreach($branches as $branch)
                            <?php
                            $names = $branch->name;
                            ?>
                            <option value="{{$branch->id}}">{{$names}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
            </div>
            <div class="col-md-7 col-md-offset-2">
                <div class="col-md-6 " style="margin-top:20px; width:70; height:100px;">
                <!-- a class='btn btn-block' style="background-color:#707b7c " href="{{ route('products.index') }}" -->
                    <a class='btn btn-block' style="background-color: #1c2833  " href="{{ route('products.index') }}">
                        <p style="color: #fdfefe ">Guardar</p>
                    </a></div>
                <div class="col-md-6 " style="margin-top:20px;">
                    <!-- a class="btn btn-block  " style="background-color:#2c3e50 " href="{{url('productIndex')}}" -->
                    <a class="btn btn-block  " style="background-color:#566573  " href="{{url('productIndex')}}">
                        <p style="color: #fdfefe ">Regresar</p>
                    </a>
                </div>
            </div>
            </form>
    </div>
</div>
<br>
<br>
<br>
@endsection