<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

/**
 * 
 * This class manage the IMEC of the accounts in the database 
 * 
 * */

class UserController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var user
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(User $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the accounts in the sistem.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando las cuentas");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");

		//Gets all de accounts in the sistem
		$users = DB::table('users') 
		->join('user_types', 'users.user_type_id', 'user_types.id')
		->join('branches', 'users.branch_id', 'branches.id')
		->select('users.active_flag as active_flag',
		'users.email as email',
		'users.id as id',
		'users.name as name',
		'users.lastname as lastname',
		'users.second_lastname as second_lastname',
		'user_types.name as user_type_name',
		'branches.name as branch_name')
		->get();

		/*return the param with all accounts to the view;*/
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.accounts.index', compact('users'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " accediendo a la creación de cuentas");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "user");

		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.accounts.create');
		}
	}

	/**
	 * Store a newly account in the database.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando la cuenta");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "user.create");

		$password = $request->input('password');
		$passwordConfirm = $request->input("password_confirmation");

		/**Check if the password is the same in both inputs */
		if ($password != $passwordConfirm) {
			return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
		}
				
		/**Check if exist a user with ne same username in the sistem */
		$username = User::where('username', $request->user_name)->get();
		if(!$username->isEmpty()) {
			return back()->withErrors(['user_name' => trans('Ya existe una cuenta registrada con este nombre de usuario.')])->withInput();
		}

		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		$user = new User();
		
		$user->active_flag = 1;
		$user->branch_id = $request->dropBranch;
		$user->username = $request->user_name;
		$user->name = $request->name;
		$user->lastname = $request->lastname;
		$user->second_lastname = $request->second_lastname;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->user_type_id = $request->dropRol;
		$user->save();
		$user_type = Auth::user()->user_type_id;
		
		DB::commit();//commits to database 
		if($user_type == 1){//admin user
			return redirect()->route('user.index')->with('success', '¡Cuenta registrada satisfactoriamente!');;
			
		}
	}

	/**
	 * Display the datas of a specific account.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->model->findOrFail($id);
		
		return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified account of a client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " editando la cuenta");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "user");
	
		$user = $this->model->find($id);
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.accounts.edit', compact('user'));	
		}
		
	}

	/**
	 * Update the specified account in the database.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " actualizando la cuenta");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "user");

		/**Check if exist a user with the same username in the sistem */
		if ($request->input("user_name") != $request->input("original_username")) {
			$username = User::where('username', $request->user_name)->get();
			if(!$username->isEmpty()) {
				return back()->withErrors(['user_name' => trans('Ya existe una cuenta registrada con este nombre de usuario.')]);
			}
		}

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		
		$user = $this->model->find($id);
		$user->branch_id = $request->dropBranch;
		$user->username = $request->user_name;
		$user->name = $request->name;
		$user->lastname = $request->lastname;
		$user->second_lastname = $request->second_lastname;
		$user->email = $request->email;
		$user->user_type_id = $request->dropRol;
		$user->update();
		
		$user_type = Auth::user()->user_type_id;		
		DB::commit();//commits to database 
		if($user_type == 1){//admin user
			return redirect()->route('user.index')->with('success', '¡Cuenta actualizada satisfactoriamente!');
			
		}
	}//End update accound

	/**
	 * Desactivate an specific account from user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " desactivando la cuenta");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "user");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		
		$user = $this->model->find($id);
		$user->active_flag = 0;
		$user->save();
		
		DB::commit();//commit to database
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('user.index')->with('success', '¡Cuenta desactivada satisfactoriamente!');;
		}
	}

	/**
	 * Activate an specific account from user.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function activate($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " activando la cuenta");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "user");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.

		$user = $this->model->findOrFail($id);
		$user->active_flag = 1;
		$user->save();

		DB::commit();//commit to database
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('user.index')->with('success', '¡Cuenta activada satisfactoriamente!');;
			
		}
	}

	/**
	 * 
	 * Get all the branches in the database.
	 * 
	 */
	public function ajax_branch(){
        $branches=DB::table('branches')->where('active_flag', '=', 1)->orderBy('name','desc')->get();
        if ($branches == null || $branches->isEmpty()) {
            Flash::message("No hay sucursales para mostrar");
        }
        return json_encode(["branches"=>$branches]);
	}


	/**
	 * 
	 * Get all the rols in the database.
	 * 
	 */
	public function ajax_rol(){
        $user_types=DB::table('user_types')->where('active_flag', '=', 1)->orderBy('name','asc')->get();
        if ($user_types == null || $user_types->isEmpty()) {
            Flash::message("No hay puestos para mostrar");
        }
        return json_encode(["user_types"=>$user_types]);
	}
}