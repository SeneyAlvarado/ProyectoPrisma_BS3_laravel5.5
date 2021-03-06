@extends('masterAdmin')
@section('contenido_Admin')

<script src="{{asset('/js/Users/load_branches_admin.js')}}"></script>
<script src="{{asset('/js/createClientsRadio.js')}}"></script>
<script src="{{asset('/js/patternFields.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/css/botonesCrear.css')}}">

@include('error')

<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Productos</h5>
        <div class="card-body">
            <div class="container-fluid">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="branch_id"  value="{{ $product->branch_id }}">

                    <div>
                        <div class=" row offset-md-2 col-md-7" style="margin-top:10px;">
                            <label for="name"><strong>Nombre</strong></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $product->name ) }}" required />
                        </div>
                    </div>
                    <br>
                    <div>
                        <div class="row offset-md-2 col-md-7" style="margin-top:10px;">
                            <label for="description-field"><strong>Descripción</strong></label>
                            <textarea class="form-control" name="description" id="description-field" value="{{ old('description', $product->description ) }}" rows="4" cols="50">{{ old('description', $product->description ) }}</textarea>
                        </div>
                    </div>
                    <div class="row offset-md-2 col-md-7" style="margin-top:10px;">
                        <label for="branch"><strong>Sucursal</strong></label>
                        <select id="dropBranch" name="dropBranch" class="form-control"></select>
                    </div>
                    <div class="row justify-content-center col-md-7 offset-md-2">
                        <div class="col-md-6 " style="margin-top:20px;  ">
                            <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                        <div class="col-md-6 " style="margin-top:20px;">
                            <a class="btn btn btn-block " href="{{route('products')}}">
                                <i class="fa fa-floppy-o"></i> Regresar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/js/Users/load_branches_admin.js')}}"></script>
@endsection