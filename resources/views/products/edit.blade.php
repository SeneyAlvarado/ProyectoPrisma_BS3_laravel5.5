@extends('masterPrueba3')

@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-edit"></i> Product / Edit #{{$product->id}}</h1>
</div>
@endsection

@section('contenido_Admin')
@include('error')

<!-- <div class="row">
    
        <div class="col-md-12"> -->
<!--
<form action="{{ route('products.update', $product->id) }}" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="name-field">Name</label>
        <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $product->name ) }}" />
    </div>
    <div class="form-group">
        <label for="description-field">Description</label>
        <input class="form-control" type="text" name="description" id="description-field" value="{{ old('description', $product->description ) }}" />
    </div>
    <div class="form-group">
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
    </div>

    <div class="well well-sm">
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
    </div>
</form>

</div>
</div>
</div>
-->
<!-- *************************************************************** -->

<div class="panel panel-primary border-panel">
    <div class="panel-heading  border-header bg-color-panel">
        <p class="title-panel" style="font-size:20px;">Crear Producto</p>
    </div>
    <div class="panel-body">
        <section class="">
            <div class="">


                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div>
                        <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $product->name ) }}" />
                        </div>
                        <div class="col-md-4 " style="margin-top:10px;">
                            <label for="description-field">Description</label>
                            <label for="description-field">Description</label>
                        </div>
                    </div>

                    <div class="col-md-4 " style="margin-top:10px;">
                        <label for="active_flag"><strong>Active Flag</strong></label>
                        <br>
                        <input type="radio" name="active_flag" value="1"> Activo<br>
                        <input type="radio" name="flactive_flagag" value="0"> Desactivado<br>
                    </div>
                    <div class="col-md-4 col-md-offset-2" style="margin-top:10px;">
                        <label for="branch"><strong>Sucursal</strong></label>
                        <select id="dropBranch" name="dropBranch" class="form-control"></select>
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                    </div>
                </form>
            </div>
    </div>
    <br>
    <br>
    <br>

    <!-- *************************************************************** -->


    @endsection