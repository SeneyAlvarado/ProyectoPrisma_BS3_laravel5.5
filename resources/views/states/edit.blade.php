@extends('masterAdmin')

@section('contenido_Admin')
    @include('error')
    <link rel="stylesheet" type="text/css" href="{{asset('css/states.css')}}">
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('actualizarEstados', $state->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
	<label for="name-field">Nombre</label>
	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $state->name ) }}" />
</div> <div class="form-group">
	<label for="description-field">Descripcion</label>
	<input class="form-control" type="text" name="description" id="description-field" value="{{ old('description', $state->description ) }}" />
</div>

                <div>
                    <button type="submit" class="btn btn-primary" href="{{ url('estados') }}">Regresar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    
                </div>
            </form>

        </div>
    </div>
@endsection