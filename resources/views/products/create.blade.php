@extends('masterPrueba3')

@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-plus"></i> Productos </h1>
</div>
@endsection

@section('contenido_Admin')
@include('error')

<!--  <div class="row">
        <div class="col-md-12"> -->
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

                    <!--   <div class="form-group">
	<label for="name-field">Name</label>
	<input class="form-control" type="text" name="name" id="name-field" value="" />
</div> <div class="form-group">
	<label for="description-field">Description</label>
	<input class="form-control" type="text" name="description" id="description-field" value="" />
</div> -->
                    <div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                            <label for="name"><strong>Nombre</strong></label>
                            <input id="name" placeholder="Nombre" class="form-control" name="name" type="text" required pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo">
                        </div>
                        <div class="col-md-4 " style="margin-top:10px;">
                            <label for="description"><strong>Descripcion</strong></label>
                            <input id="description" placeholder="Descripci[on" class="form-control" name="description" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required>
                        </div>
                    </div>
                    <div class="col-md-4 " style="margin-top:10px;">
                        <label for="active_flag"><strong>Active Flag</strong></label>
                        <br>
                        <input type="radio" name="active_flag" value="1"> Activo<br>
                        <input type="radio" name="flactive_flagag" value="0"> Desactivado<br>
                    </div>
                    <div class="col-md-4 " style="margin-top:10px;">
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


            <!-- <div class="form-group">
                        <label for="active_flag-field">Active_flag</label>
                        --active_flag--
                    </div>
                    <div class="form-group">
                        <label for="branch_id-field">Branch_id</label>
                        --branch_id--
                    </div>
                    <div class="form-group">
                        <label for="branch_id-field">Branch_id</label>
                        --branch_id--
                    </div> -->

            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </div>
            </form>
    </div>
</div>
<br>
<br>
<br>
@endsection