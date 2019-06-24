@extends('masterAdmin')
@section('contenido_Admin')
<script src="{{asset('js/load_branches_admin.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<div style="padding:10px;">
    <div class="card">
        <h5 class="card-header" style="text-align:center">Estados</h5>
        <div class="card-body">
            <div class="container-fluid">
                <div class="">
                    <form action="{{ url('saveState') }}" method="POST">
                        <input type="hidden" name="_token" value='{{Session::token()}}'>
                        <div class="row justify-content-center">
                            <div class="col-md-7 align-self-center">
                                <label for="name-field"><strong>Nombre</strong></label>
                                <input class="form-control" type="text" name="name" id="name-field" value="" required/>
                            </div> <div class="col-md-7 align-self-center">
                                <label for="description-field"><strong>Descripción</strong></label>
                                <input class="form-control" type="text" name="description" id="description-field" value="" required/>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-3 col-md-offset-2" style="margin-top:5px;  ">
                                <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3" style="margin-top:5px; ">
                                <a class="btn btn btn-block" href="{{ url('states') }}">Cancelar</a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection