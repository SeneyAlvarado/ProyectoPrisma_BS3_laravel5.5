<?php

namespace App\Exceptions;

use Exception;
use \Session;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        return parent::render($request, $exception);
        //return dd($exception);
        //return parent::render($request, $exception);

        //return dd($exception);
        //return $request;
        //return $exception . $var;
        //

        if($exception instanceof \ErrorException) {
            Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Success');
            Session::flash('error', '¡Ha ocurrido un error ' . $errorOrigin . "!" 
            .' Si este persiste contacte al administrador del sistema');
            return redirect()->back();

        }elseif($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Success');
            Session::flash('error', '¡La página a la que ha intentado
            acceder no existe o no es accesible en este momento!');
            return back();
        
        }elseif($exception instanceof \Symfony\Component\Debug\Exception\FatalThrowableError) {
            Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Success');
            Session::flash('error', '¡Ha ocurrido un error!');
            return back();
        }elseif($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return Redirect::back()->withErrors($validator)->withInput();
        
        }elseif($exception instanceof \UnexpectedValueException) {
            Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Success');
            Session::flash('error', '¡Ha ocurrido un error con un valor no válido al ' . $errorOrigin . "!" 
            .' Si este persiste contacte al administrador del sistema');
            return back();
        
        }elseif($exception instanceof \Illuminate\Database\QueryException) {
            Session::flash('message_type', 'negative');
			Session::flash('message_icon', 'hide');
			Session::flash('message_header', 'Success');
            Session::flash('error', '¡Ha ocurrido un error en la consulta a la base de datos!'
            .' Si este persiste contacte al administrador del sistema');
            return back();
        
        }else{/*Original error handling*/
            return parent::render($request, $exception);
        }
    }
}
