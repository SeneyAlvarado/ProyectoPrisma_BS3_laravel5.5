<?php

namespace App\Exceptions;

use Exception;
use \Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $errorMessage = $exception->getMessage();

        //if the error contains the message "Session store not set...." it won´t save it completely at the log
        if ((strpos($errorMessage, 'Session store') !== false) == false) {
            parent::report($exception);
        } else {
            logger("Session store error. User ID:" . print_r(array_filter([
                'userId' => Auth::id(),
                'email' => Auth::user() ? Auth::user()->email : null,
            ])) . " ---- Date (Costa Rica): " . Carbon::now(new \DateTimeZone('America/Costa_Rica'))   );
        }
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
        
        if($request->session()->has('errorOrigin'))
        {
            $errorOrigin = $request->session()->pull('errorOrigin');
        } else{
            $errorOrigin = "";
        }
        
        //session()->forget('errorOrigin');
        //return dd(session());
        //return parent::render($request, $exception);
        
        //return dd($exception);
        //return parent::render($request, $exception);

        //just in case someone throws it but don´t has the try catch at the code
        if($exception instanceof \App\Exceptions\CustomException) {
            //$request->session()->flash('message_type', 'negative');
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error ' . $errorOrigin . "!" 
            .' Si este persiste contacte al administrador del sistema');
            return redirect()->back();

        }elseif($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡La página a la que ha intentado
            acceder no existe o no es accesible en este momento!');
            return back();
        
        }elseif($exception instanceof \Symfony\Component\Debug\Exception\FatalThrowableError) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error inesperado!');
            return back();
        }elseif($exception instanceof \Illuminate\Auth\AuthenticationException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error con la sesión!');
            return back();
        
        }elseif($exception instanceof \UnexpectedValueException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error con un valor no válido al ' . $errorOrigin . "!" 
            .' Si este persiste contacte al administrador del sistema');
            return back();
        
        }elseif($exception instanceof \Illuminate\Database\QueryException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error en la consulta a la base de datos!'
            .' Si este persiste contacte al administrador del sistema');
            return back();
        
        }elseif($exception instanceof \RuntimeException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error de ejecución en el servidor');
            return back();
        
        }elseif($exception instanceof \UnexpectedValueException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error con un valor de la consulta! Si este persiste
            llame al administrador del sistema');
            return back();
        
        }elseif($exception instanceof \ErrorException) {
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error ' . $errorOrigin . "!" 
            .' Si este persiste contacte al administrador del sistema');
            return redirect()->back();








        }elseif($exception instanceof \Exception) {//this should be the LAST one, gets any Exception
            \Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error ' . $errorOrigin . "!" 
            .' Si este persiste contacte al administrador del sistema');
            return redirect()->back();
                
        }else{/*Original error handling*/
            return parent::render($request, $exception);
        }
    }
    
}
