@extends('masterPrueba3')
@section('contenido_Admin')
<div class="panel panel-primary border-panel">
        <div class="panel-heading  border-header bg-color-panel" >
                <p class="title-panel" style="font-size:20px;">Crear cuentas</p>
            </div>
            <div class="panel-body">
                    <section class="">
                    <div class="">
            <form action="{{ route('clients.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                        <label for="type-field">Type</label>
                        --type--
                    </div> <div class="form-group">
                        <label for="name-field">Name</label>
                        <input class="form-control" type="text" name="name" id="name-field" value="" />
                    </div> <div class="form-group">
                        <label for="address-field">Address</label>
                        <input class="form-control" type="text" name="address" id="address-field" value="" />
                    </div> <div class="form-group">
                        <label for="active_flag-field">Active_flag</label>
                        --active_flag--
                    </div> <div class="form-group">
                        <label for="identification-field">Identification</label>
                        <input class="form-control" type="text" name="identification" id="identification-field" value="" />
                    </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection