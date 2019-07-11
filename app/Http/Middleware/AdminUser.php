<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminUser
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
            if(Auth::user()->user_type_id != 1) {//if the user is NOT an administrator
                \Session::flash('error', '¡No posee permiso para acceder a esa sección!');
                return redirect('/'); 
            } else {//if the user is an administrator redirect to the page
                return $next($request);
            }
        } else {//if the user is not logged in
            \Session::flash('error', '¡Por favor inicie sesión!');
            return redirect('/'); 
        }
    }
}
