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
    protected $redirectTo = '/';

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
                $user_type = Auth::user()->user_type_id;    
                if($user_type == 1){//admin user
                    return redirect('user');
                } else if ($user_type == 2) {
                    return redirect('clients');
                    //return view('designer.password.change_password');
                } else if($user_type == 3){//boss designer user
                    return redirect('works');
                } else if($user_type == 4){//designer user
                    return redirect('works');
                }else if($user_type == 5){//boss print user
                    return redirect('works');
                }else if($user_type == 6){//regular print user
                    return redirect('works');
                }
                
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
            //return back()->withErrors(['password' => 'Su cuenta está desactivada. Contacte con 
            //Grupo Prisma para verificar']);     
            return back()->with('error', 'Su cuenta está desactivada. Contacte con Grupo Prisma para verificar');
        }
        } else {  //In case the credentials are incorect.
        //return back()->withErrors(['username' => trans('Nombre de usuario o contraseña incorrectos.')]);        
        return back()->with('error', 'Nombre de usuario o contraseña incorrectos');
    }
    }

    public function logout () {
        auth()->logout();
        Auth::logout();
        return redirect('/');
    }
}
