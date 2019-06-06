@extends('masterAdmin')

@section('contenido_Admin')
    @include('error')
    <link rel="stylesheet" type="text/css" href="{{asset('css/states.css')}}">
    <div>
        <h1>Crear estado</h1>
        <br>
    </div>
    <div class="row">
        <div class="col-md-12">

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
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>

        </div>
    </div>
@endsection