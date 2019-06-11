@extends('masterAdmin')

@section('contenido_Admin')
    @include('error')
    <link rel="stylesheet" type="text/css" href="{{asset('css/states.css')}}">
    <script src="{{asset('js/createClientsRadio.js')}}"></script>
    <script src="{{asset('js/requiredFields.js')}}"></script>
    
    <div style="padding:10px;">
    <div class="panel panel-primary border-panel">
        <div class="panel-heading  border-header bg-color-panel" >
                <p class="title-panel" style="font-size:20px;">Detalles</p>
        </div>
        <div class="panel-body">
            <section class="">
                <div class="">

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
    </section>
</div>
</div>
</div>
@endsection