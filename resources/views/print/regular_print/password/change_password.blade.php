@extends('masterPrint')
@section('content_Print')

<link rel="stylesheet" type="text/css" href="{{asset('css/botonesCrear.css')}}">
<div style="padding:10px;">
        <div class="card">
            <h5 class="card-header" style="text-align:center">Contraseña</h5>
            <div class="card-body">
                <div class="container-fluid">
                <form action="{{ route('change_password.update', Auth::user()->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-4 " >
                                    <label for="password"><strong>Contraseña nueva</strong></label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña nueva" required/>
                                    @if ($errors->has('password'))
                                    <span class="help-block" style="color:red;"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-4 " >
                                    <label for="password-confirm"><strong>Confirmar contraseña</strong></label>
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar contraseña" id="password-confirm" required/>
                                    </div>
                                    <div class="well well-sm">
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="row justify-content-center">
                               
                            </div>        
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-md-offset-2" style="margin-top:5px;  ">
                                <button class='btn btn-success btn-block' type='submit'><i class="fa fa-floppy-o"></i>Actualizar</button>
                            </div>
                         
                            <div class="col-md-4" style="margin-top:5px; ">
                                <a class="btn btn btn-block" href="{{route('works.index')}}">Cancelar</a>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection