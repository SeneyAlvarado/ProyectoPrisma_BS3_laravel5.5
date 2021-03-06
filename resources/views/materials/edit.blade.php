@extends('masterAdmin')
@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-edit"></i> Product / Edit #{{$material->id}}</h1>
</div>
@endsection

@section('contenido_Admin')
<script src="{{asset('/js/Users/load_branches_admin.js')}}"></script>
<script src="{{asset('/js/createClientsRadio.js')}}"></script>
<script src="{{asset('/js/patternFields.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/css/botonesCrear.css')}}">

@include('error')

<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Materiales</h5>
        <div class="card-body">
            <div class="container-fluid">
                <form action="{{ route('materials.update', $material->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="branch_id"  value="{{ $material->branch_id }}">

                    <div>
                        <div class=" row offset-md-2 col-md-7" style="margin-top:10px;">
                            <label for="name"><strong>Nombre</strong></label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $material->name ) }}" required/>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div class="row offset-md-2 col-md-7" style="margin-top:10px;">
                            <label for="description-field"><strong>Descripción</strong></label>
                            <textarea class="form-control" style="resize:none" name="description" id="description-field" value="{{ old('description', $material->description ) }}" rows="4" cols="50">{{ old('description', $material->description ) }}</textarea>
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
                            <a class="btn btn btn-block " href="{{route('materials')}}">
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