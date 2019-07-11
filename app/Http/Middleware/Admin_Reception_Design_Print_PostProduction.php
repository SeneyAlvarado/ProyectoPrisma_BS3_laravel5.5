<?php

namespace App\Http\Middleware;

use Closure;

class Admin_Reception_Design_Print_PostProduction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {//if the user is logged in
            if(Auth::user()->user_type_id != 1 && Auth::user()->user_type_id != 2
            && Auth::user()->user_type_id != 3 && Auth::user()->user_type_id != 4
            && Auth::user()->user_type_id != 7) {

                //if the user is NOT an admin, receptionist, dessigner, boss designer or PostProduction
                \Session::flash('error', '¡No posee permiso para acceder a esa sección!');
                return redirect('/'); 

            } else {//if the user is an administrator, receptionist,dessigner, boss designer or PostProduction 
                //redirect to the page
                return $next($request);
            }
        } else {//if the user is not logged in
            \Session::flash('error', '¡Por favor inicie sesión!');
            return redirect('/'); 
        }
    }
}
