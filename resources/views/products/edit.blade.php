@extends('masterPrueba3')

@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-edit"></i> Product / Edit #{{$product->id}}</h1>
</div>
@endsection

@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin.js')}}"></script>
@include('error')

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
                        <div class="col-md-7 col-md-offset-2" style="margin-top:10px;">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $product->name ) }}" />
                        </div>
                    </div>
                    <br>

                    <div class="col-md-7 col-md-offset-2">
                        <hr>
                    </div>
                    <div>
                        <div class="col-md-7 col-md-offset-2" style="margin-top:10px;">
                            <label for="description-field">Description</label>
                            <textarea class="form-control" name="description" id="description-field" value="{{ old('description', $product->description ) }}" rows="4" cols="50"></textarea>
                            <!-- <input class="form-control" type="text" name="description" id="description-field" value="{{ old('description', $product->description ) }}" />-->
                        </div>
                    </div>
                    
                    <div class="col-md-7 col-md-offset-2"><hr></div>

                    <div class="col-md-7 col-md-offset-2" style="margin-top:10px;">
                        <label for="active_flag"><strong>Active Flag</strong></label>
                        <br>
                        <input type="radio" name="active_flag" value="1" checked> Activo<br>
                        <input type="radio" name="flactive_flagag" value="0"> Desactivado<br>
                    </div>
                    <div class="col-md-7 col-md-offset-2"><hr></div>
                    <div class="col-md-7 col-md-offset-2" style="margin-top:10px;">
                        <label for="branch"><strong>Sucursal</strong></label>
                        <select id="dropBranch" name="dropBranch" class="form-control"></select>
                    </div>


                    <!--   <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                    </div> -->

                    <div class="col-md-7 col-md-offset-2">
                        <div class="col-md-6 " style="margin-top:20px; width:70; height:100px;">
                            <a class='btn btn-block' style="background-color:#707b7c " href="{{ route('products.index') }}">
                                <p style="color: #fdfefe ">Guardar</p>
                            </a></div>
                        <div class="col-md-6 " style="margin-top:20px;">
                            <a class="btn btn-block  " style="background-color:#2c3e50 " href="{{url('productIndex')}}">
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
    <script src="{{asset('js/load_branches_admin.js')}}"></script>
    @endsection