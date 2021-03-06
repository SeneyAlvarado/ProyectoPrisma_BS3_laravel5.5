<?php

namespace App\Http\Controllers;
use App\Paciente;
use App\User;
use Auth;

use Illuminate\Http\Request;


class ChanngePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ChanngePasswordController
    |--------------------------------------------------------------------------
    | This controller is responsible for handling the password change.
    |
	*/
    
    /**
     * This method is responsible for handling the password change of the users.
     */
    public function update(Request $request)
	{
        
        $user = User::where('id', Auth::user()->id)->first();
        $user->password = bcrypt($request->input('password'));
        $password = $request->input('password'); //New password incoming.
        $passwordConfirm = $request->input("password_confirmation");//Password confirmation incoming.
        if ($password != $passwordConfirm) { //Error message in case the passwords do not match.
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $user->save();
		$user_type = Auth::user()->user_type_id;
            
        return redirect()->route('change_password.search_user')->with('success', 'Contraseña actualizada satisfactoriamente!');
            
    }

    /**
     * This method is responsible of return the view according to the type of user.
     */
    public function search_user()
	{
		$user_type = Auth::user()->user_type_id;
			if($user_type == 1){//admin user
				return view('admin.password.change_password');
			}else if ($user_type == 2) {
                return view('reception.password.change_password');
            } else if ($user_type == 3) {
                return view('designer.password.change_password');
            }else if ($user_type == 4) {
                return view('designer.password.change_password');
            }else if ($user_type == 5) {
                return view('print.print_boss.password.change_password');
            }else if ($user_type == 6) {
                return view('print.regular_print.password.change_password');
            }else if ($user_type == 7) {//post production user
                return view('postProduction.password.change_password');
            }
    }
}
