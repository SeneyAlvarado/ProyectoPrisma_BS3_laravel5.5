<?php

namespace App\Http\Middleware;

use Closure;
use Auth; 

class Admin_Reception
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
            if(Auth::user()->user_type_id != 1 && Auth::user()->user_type_id != 2) {//if the user is NOT an admin or receptionist
                \Session::flash('error', '¡No posee permiso para acceder a esa sección!');
                return redirect('/'); 
            } else {//if the user is an administrator or receptionist redirect to the page
                return $next($request);
            }
        } else {//if the user is not logged in
            \Session::flash('error', '¡Por favor inicie sesión!');
            return redirect('/'); 
        }
    }
}
