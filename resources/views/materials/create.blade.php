<link rel="stylesheet" type="text/css" href="{{asset('/css/botonesCrear.css')}}">
@extends('masterAdmin')
@section('header')
<div class="page-header">
    <h1><i class="glyphicon glyphicon-plus"></i> Materiales </h1>
</div>
@endsection

@section('contenido_Admin')
@include('error')
<script src="{{asset('/js/Users/load_branches_admin.js')}}"></script>

<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Materiales</h5>
        <div class="card-body">
            <div class="container-fluid">
                <div class="">
                    <form action="{{ route('materials.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <!-- <div class="row justify-content-center"> -->
                        <div>
                            <!-- <div class="col-md-4 align-self-center"> -->
                            <div class=" row offset-md-2 col-md-7" style="margin-top:10px;">
                                <label for="name"><strong>Nombre</strong></label>
                                <input id="name" placeholder="Nombre" class="form-control" name="name" type="text" required >
                            </div>
                        </div>
                        <div>
                            <div class="row offset-md-2 col-md-7" style="margin-top:10px;">
                                <!--<div class="col-md-4 align-self-center"> -->
                                <label for="description"><strong>Descripción</strong></label>
                                <textarea class="form-control" name="description" style="resize:none;" id="description" rows="4" cols="50"></textarea>
                              <!--  <input class="form-control" style="resize:none;" placeholder="Descripción" name="description" id="description-field">-->

                                <!-- <input id="description" placeholder="Descripci[on" class="form-control" name="description" type="text" pattern="[a-zA-Z-ñÑáéíóúÁÉÍÓÚ \s]{2,48}" title="No se permiten números en este campo" required> -->
                            </div>
                        </div>
                        <div class="row offset-md-2 col-md-7" style="margin-top:10px;">
                            <!-- <div class="row " style="margin-top:15px;"> -->
                            <!--   <div class="col-md-4 offset-md-2"> -->
                            <label for="branch"><strong>Sucursal</strong></label>
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
                            <!-- </div> -->
                        </div>

                        <!-- <div class="row justify-content-center" style="margin-top:15px;">
                            <div class="col-md-8">
                                <label for="active_flag"><strong>Estado</strong></label>
                                <br>
                                <input type="radio" name="active_flag" value="1" checked> Activo<br>
                                <input type="radio" name="active_flag" value="0"> Desactivado<br>
                            </div>
                        </div> -->

                        <div class="row justify-content-center col-md-7 offset-md-2">
                            <!-- <div class="row justify-content-center"> -->
                            <div class="col-md-6 " style="margin-top:20px;  ">
                                <!--  <div class="col-md-4 col-md-offset-2" style="margin-top:5px; "> -->
                                <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                            <div class="col-md-6 " style="margin-top:20px;">
                                <!--   <div class="col-md-4" style="margin-top:5px; "> -->
                                <a class="btn btn btn-block" href="{{ route('materials')}}">Regresar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection