<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

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
		try {
			
			//custom message if this methods throw an exception
			\Session::put('errorOrigin', " accediendo a la creación de cuentas");	

			$user_type = Auth::user()->user_type_id;
			if($user_type == 1){//admin user
				return view('admin.accounts.create');
			}
		}catch(\Illuminate\Database\QueryException $e){
			report($e);
			return redirect('clients')->with('error', '¡Error en la base de datos
			 en la creación de cuentas!');
		}
		catch(\Exception $e){
			report($e);
			return redirect('clients')->with('error', '¡Error en la creación de cuentas!');
		}
	}

	/**
	 * Store a newly account in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		try {
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
		$user = new User();
		$password = $request->input('password');
		$passwordConfirm = $request->input("password_confirmation");
		/**Check if the password is the same in both inputs */
		if ($password != $passwordConfirm) {
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
		}
		
		/**Check if exist a user with ne same username in the sistem */
		$username = User::where('username', $request->user_name)->get();
		if(!$username->isEmpty()) {
			return back()->withErrors(['user_name' => trans('Ya existe una cuenta registrada con este nombre de usuario.')]);
		}

		/**Check if exist a user with ne same email in the sistem
		$email = User::where('email', $request->email)->get();
		if(!$email->isEmpty()) {
			return back()->withErrors(['user_name' => trans('Ya existe un usuario con el correo indicado.')]);
		} */

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
	}catch(\Exception $e) {
		report($e);//this writes the error at the log
		DB::rollback();
		\Session::flash('error', '¡Ha ocurrido un error al insertar la cuenta!' 
		.' Si este persiste contacte al administrador del sistema');
		return redirect('user.index');//aquí redirigen a la página deseada después de validar el error
	}catch(\Throwable $e){//different exception that it´s not contained at \Exception
		report($e);//this writes the error at the log
		DB::rollback();
		\Session::flash('error', '¡Ha ocurrido un error al insertar la cuenta!' 
		.' Si este persiste contacte al administrador del sistema');
		return redirect('user.index');//aquí redirigen a la página deseada después de validar el error
	}
		
	}

	/**
	 * Display the specified resource.
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	
		$user = $this->model->findOrFail($id);
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.accounts.edit', compact('user'));	
		}
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		try {
		DB::beginTransaction();
		/**Check if exist a user with the same username in the sistem */
		if ($request->input("user_name") != $request->input("original_username")) {
			$username = User::where('username', $request->user_name)->get();
			if(!$username->isEmpty()) {
				return back()->withErrors(['user_name' => trans('Ya existe una cuenta registrada con este nombre de usuario.')]);
			}
		}
		//Check if exist a user with ne same email in the sistem 
		if ($request->input("email") != $request->input("original_email")) {
			$email = User::where('email', $request->email)->get();
				if(!$email->isEmpty()) {
			return back()->withErrors(['user_name' => trans('Ya existe un usuario con el correo indicado.')]);
			}
		}

		$user = $this->model->findOrFail($id);
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
			return redirect()->route('user.index')->with('success', '¡Cuenta actualizada satisfactoriamente!');;
			
		}
		
	}catch(\Exception $e) {
		report($e);//this writes the error at the log
		DB::rollback();
		\Session::flash('error', '¡Ha ocurrido un error al actualizar la cuenta!' 
		.' Si este persiste contacte al administrador del sistema');
		return redirect('user.edit/'.$id);//aquí redirigen a la página deseada después de validar el error
	}catch(\Throwable $e){//different exception that it´s not contained at \Exception
		report($e);//this writes the error at the log
		DB::rollback();
		\Session::flash('error', '¡Ha ocurrido un error al actualizar la cuenta!' 
		.' Si este persiste contacte al administrador del sistema');
		return redirect('user.edit/'.$id);//aquí redirigen a la página deseada después de validar el error
	}//End Try-Catch

	}//End update accound

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->model->findOrFail($id);
		$user->active_flag = 0;
		$user->save();
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('user.index')->with('success', '¡Cuenta desactivada satisfactoriamente!');;
		}
	}

	public function activate($id)
	{
		$user = $this->model->findOrFail($id);
		$user->active_flag = 1;
		$user->save();
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('user.index')->with('success', '¡Cuenta activada satisfactoriamente!');;
			
		}
	}

	public function ajax_branch(){
        $branches=DB::table('branches')->where('active_flag', '=', 1)->orderBy('name','desc')->get();
        if ($branches == null || $branches->isEmpty()) {
            Flash::message("No hay sucursales para mostrar");
        }
        return json_encode(["branches"=>$branches]);
	}

	public function ajax_rol(){
        $user_types=DB::table('user_types')->where('active_flag', '=', 1)->orderBy('name','asc')->get();
        if ($user_types == null || $user_types->isEmpty()) {
            Flash::message("No hay puestos para mostrar");
        }
        return json_encode(["user_types"=>$user_types]);
	}
}