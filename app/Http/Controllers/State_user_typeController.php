<?php

namespace App\Http\Controllers;

use App\State_user_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use App\State;

class State_user_typeController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var state_user_type
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(State_user_type $model)
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

		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando los accesos a trabajos");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");
		
		 $state_user_types = DB::table('state_user_types')->where('state_user_types.active_flag', 1)->join('states', 'state_user_types.states_id', '=', 'states.id')
		->join('user_types', 'state_user_types.user_types_id', '=', 'user_types.id')
		->select('state_user_types.id as id','states.name as state_name', 'user_types.name as user_type_name', 
		'state_user_types.active_flag as active_flag', 'state_notification')->get();

		$user_type = Auth::user()->user_type_id;
			if($user_type == 1){//admin user
				return view('admin.state_user_types.index', compact('state_user_types'));
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
		\Session::put('errorOrigin', " accediendo a la creación de Acceso a Trabajos");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "state_user_types");

		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.state_user_types.create');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{

		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando el Acceso a Trabajo");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "state_user_types.create");

		$dropRol = $request->dropRol;
		$dropState = $request->dropState;
		
		$state_user_type = \App\State_user_type::where('user_types_id', $dropRol)
		->where('states_id', $dropState)->where('active_flag', 1)->first();
		//return $state_user_type;

		if($state_user_type != null) {
			return back()->with('error', 'Ya existe un Acceso de Trabajo activo para 
			el puesto y el estado indicado');
		}

		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.

		$state_user_type = new \App\State_user_type;
		$state_user_type->states_id = $dropState;
		$state_user_type->user_types_id = $dropRol;
		$state_user_type->state_notification = $request->notification;
		$state_user_type->active_flag = 1;
		$state_user_type->save();

		DB::commit();//commits to database 
		return redirect('state_user_types')->with('success', 'Acceso a Trabajo registrado satisfactoriamente!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$state_user_type = $this->model->findOrFail($id);
		
		return view('state_user_types.show', compact('state_user_type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

			//custom message if this methods throw an exception
			\Session::put('errorOrigin', " editando el cliente");	

			//custom route to REDIRECT redirect('x') if there's an error
			\Session::put('errorRoute', "clients");

			$state_user_types = $this->model->find($id);

			if($state_user_types == null) {
				throw new \Exception('Error en editar el Acceso a Trabajo con el id:' .$id
			. " en el método State_user_typeController@edit");
			} else {

					$state =  \App\State::where('id', $state_user_types->states_id)->first();
					$state_user_types->state_name = $state->name;

					$user_type =  \App\User_type::where('id', $state_user_types->user_types_id)->first();
					$state_user_types->user_type_name = $user_type->name;
					
				$user_type = Auth::user()->user_type_id;
					if($user_type == 1){//admin user
						return view('admin.state_user_types.edit', compact('state_user_types'));
					}
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

		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " actualizando el Acceso a Trabajo");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "state_user_types");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
			
		$state_user_type = $this->model->find($id);

		if($state_user_type == null) {
			throw new \Exception('Error en actualizar el Acceso a Trabajo con el id:' .$id
		. " en el método State_user_tyeController@update");
		} else {

			$state_user_type->state_notification = $request->notification;
			$state_user_type->save();

			DB::commit();//commits to database 
			return redirect('state_user_types')->with('success', '¡Acceso a trabajo
			actualizado satisfactoriamente!');
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " eliminando el Acceso a Trabajo");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "state_user_types");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.

		$state_user_types = $this->model->find($id);

		if($state_user_types == null) {
			throw new \Exception('Error en editar el Acceso a Trabajo con el id:' .$id
		. " en el método State_user_typeController@edit");
		} else {
			$state_user_types->active_flag = 0;
			$state_user_types->save();

			DB::commit();//commit to database

			$user_type = Auth::user()->user_type_id;	
			if($user_type == 1){//admin user
				return redirect('state_user_types')->with('success', 
				'Acceso a trabajo eliminado satisfactoriamente');
			}
		}
	}
}