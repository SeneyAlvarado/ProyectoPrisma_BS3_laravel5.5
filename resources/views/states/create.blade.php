@extends('masterAdmin')

@section('contenido_Admin')
    @include('error')
    <link rel="stylesheet" type="text/css" href="{{asset('css/states.css')}}">
    <script src="{{asset('js/createClientsRadio.js')}}"></script>
    <script src="{{asset('js/requiredFields.js')}}"></script>
    
    <div style="padding:10px;">
    <div class="panel panel-primary border-panel">
        <div class="panel-heading  border-header bg-color-panel" >
                <p class="title-panel" style="font-size:20px;">Crear estado</p>
        </div>
        <div class="panel-body">
            <section class="">
                <div class="">
            <form action="{{ url('guardarEstado') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Nombre</label>
	<input class="form-control" type="text" name="name" id="name-field" value="" />
</div> <div class="form-group">
	<label for="description-field">Descripción</label>
	<input class="form-control" type="text" name="description" id="description-field" value="" />
</div>

                <div>
                    <button type="submit" class="btn btn-primary" href="{{ url('estados') }}"> Regresar</a></button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </section>
</div>
</div>
</div>
@endsection