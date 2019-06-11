<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Method in charge of verifying the credential and the type of users that 
     * enter in the system.
     */
    public function login(){

        if(Auth::check()) {
            auth()->logout();
        }
        $credentials = $this->validate(request(),[
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        //return dd(Auth::attempt($credentials));

        if(Auth::attempt($credentials)){ //In case the credentials are corect.
            //return "x";
            //return dd(Auth::user());
            if(Auth::user()->active_flag == 1) { //In case the patient's account is active.
                return redirect('admin_accounts_index');
                /*$tipo = Auth::user()->tipo;
            if($tipo == 4) {
                return redirect('paciente');
            } else {
                if($tipo == 3){
                return redirect('asistente');
                } else{
                    if($tipo == 2){
                return redirect()->route('Especialista.index');
                    } else{
                        if($tipo == 1){
                return redirect('admin');
                    }
                }
              }
            }*/

          } else { //In case the patient's account was desactive.
            return back()->withErrors(['password' => 'Su cuenta está desactivada. Contacte con el 
            Servicio de Salud para verificar el procedimiento de activación']);        
        }
        } else {  //In case the credentials are incorect.
        return back()->withErrors(['username' => trans('Nombre de usuario o contraseña incorrectos.')]);        
    }
    }
}
