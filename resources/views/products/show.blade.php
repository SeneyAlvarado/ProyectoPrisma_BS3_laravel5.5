@extends('masterAdmin')
@section('header')
<div class="page-header">
    <!-- h1>Producto / Show #{{$product->id}}</h1 -->
    <h1>Producto</h1>
</div>
@endsection

@section('contenido_Admin')
@include('error')

<div class="row">

    <div class="col-md-12">
        <div>
            <div class=" row offset-md-2 col-md-7" style="margin-top:10px;">
                <label for="name">Nombre</label>
                <input class="form-control" type="text" name="name" id="name" value=" {{ $product->name }}" />
            </div>
        </div>
        <br>
        <div class="offset-md-2 col-md-7">
            <hr>
        </div>
        <div>
            <div class="row offset-md-2 col-md-7" style="margin-top:10px;">
                <label for="description-field">Description</label>
                <textarea readonly class="form-control" name="description" id="description-field" value="{{ $product->description }}" rows="4" cols="50">{{ $product->description }}</textarea>
            </div>
        </div>

        <div class="offset-md-2 col-md-7">
            <hr>
        </div>
        <div class="justify-content-center offset-md-2 col-md-4" style="margin-top:10px;">
            <label for="active_flag"><strong>Active Flag</strong></label>
            <br>
            @if($product->active_flag == 1)
            <input type="radio" name="active_flag" value="1" checked> Activo<br>
            <input type="radio" name="active_flag" value="0" disabled=""> Desactivado<br>
            @else
            <input type="radio" name="active_flag" value="1" disabled=""> Activo<br>
            <input type="radio" name="active_flag" value="0" checked> Desactivado<br>
            @endif
        </div>

        <div class="offset-md-2 col-md-7">
            <hr>
        </div>
        
        <div class=" offset-md-2 col-md-7" style="margin-top:10px;">
            <label for="branch"><strong>Sucursal</strong></label>
            <p class="offset-md-2 col-md-7">{{ $product->branch_id }}</p>
        </div>

        <div class="offset-md-2 col-md-7">
            <hr>
        </div>
        <div class="row justify-content-center col-md-7 offset-md-2">
            <div class="col-md-6 " style="margin-top:20px; width:70; height:100px;">
                <a class='btn btn-block' style="background-color:#707b7c " href="{{ route('products.index') }}">
                    <p style="color: #fdfefe ">Regresar</p>
                </a></div>
            <div class="col-md-6 " style="margin-top:20px;">
                <a class="btn btn-block  " style="background-color:#2c3e50 " href="{{ route('products.edit', $product->id) }}">
                    <p style="color: #fdfefe ">Editar</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection