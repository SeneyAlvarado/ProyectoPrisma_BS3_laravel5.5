<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*$users = $this->model->all();*/
		
		//Gets all de users in the sistem
		$users = DB::table('users') 
		->join('user_types', 'users.id', 'user_types.id')
		->join('branches', 'users.branch_id', 'branches.id')
		->select('users.active_flag as active_flag',
		'users.email as email',
		'users.name as name',
		'users.lastname as lastname',
		'users.second_lastname as second_lastname',
		'user_types.name as user_type_name',
		'branches.name as branch_name')
		->get();

		/*return $user;*/
		return view('admin.accounts.index', compact('users'));
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
		return view('users.create');
	}

	/**
	 * Store a newly account in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$password = $request->input('password');
		$passwordConfirm = $request->input("password_confirmation");
		/**Check if the password is the same in both inputs */
		if ($password != $passwordConfirm) {
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
		}
		/**Check if exist a user with ne same username in the sistem */
		$username = User::where('user_name', $request->username)->get();
	
			if(!$username->isEmpty()) {
				return back()->withErrors(['user_name' => trans('Ya existe un usuario con este nombre de usuario.')]);
		    }
		$inputs = $request->all();
		
		$this->model->create($inputs);

		return redirect()->route('users.index')->with('message', 'Item created successfully.');
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
		
		return view('users.edit', compact('user'));
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
		$inputs = $request->all();

		$user = $this->model->findOrFail($id);		
		$user->update($inputs);

		return redirect()->route('users.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->model->destroy($id);

		return redirect()->route('users.index')->with('message', 'Item deleted successfully.');
	}

	public function ajax_branch(){
        $branches=DB::table('branches')->where('active_flag', '=', 1)->orderBy('name','desc')->get();
        if ($branches == null || $branches->isEmpty()) {
            Flash::message("No hay sucursales para mostrar");
        }
        return json_encode(["branches"=>$branches]);
	}
}