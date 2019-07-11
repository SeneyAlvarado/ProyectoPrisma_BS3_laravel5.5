<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class StateController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var state
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(State $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the states.
	 *
	 * @return Response
	 */
	public function index()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando los estados");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");
		
		$states = $this->model->paginate();

		return view('admin/states/index', compact('states'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " accediendo a la creación de estados");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "states");

		return view('admin/states/create');
	}

	/**
	 * Store a newly created resource in storage.
	 * The state is the new resource, created by the admin, 
	 * is the new state take it for the works
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando el estado");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "states.create");

		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
			
		$state = new State();
		$state->name=$request->name;
		$state->description=$request->description;
		$state->active_flag = 1;
		$state->save();

		DB::commit();//commits to database 
		return redirect('states')->with('success', '¡Estado registrado satisfactoriamente!');
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
		\Session::put('errorOrigin', " editando el estado");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "states");

		$state = $this->model->find($id);
		if($state==null){
			throw new \Exception('Error en editar el estado con el id:' .$id
				. " en el método StateController@edit");
		} else{
			return view('admin/states/edit', compact('state'));
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
		\Session::put('errorOrigin', " actualizando el estado");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "states");
		
		$inputs = $request->all();
		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
			
		$state = $this->model->find($id);
		if($state==null){
			throw new \Exception('Error en actualizar el estado con el id:' .$id
				. " en el método StateController@update");
		} else {
			$state->update($inputs);
			DB::commit();//commits to database 
			return redirect('states')->with('success', '¡Estado actualizado satisfactoriamente!');
		}
	}

	/**
	 * Remove the specified state from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deactivate($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " desactivando el estado");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "states");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		$state = $this->model->find($id);
		if($state==null){
			throw new \Exception('Error en desactivar el estado con el id:' .$id
				. " en el método StateController@destroy");
		} else {
			$state->active_flag = 0;
			$state->save();
			DB::commit();//commit to database
			return redirect('states')->with('success', '¡Estado desactivado satisfactoriamente!');
		}
	}

	/**
	 * Active the specified state from storage.
	 */
	public function activate($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " activando el estado");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "states");

			DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
			$state = $this->model->find($id);
			if($state==null){
				throw new \Exception('Error en activar el estado con el id:' .$id
					. " en el método StateController@active");
			} else{
				$state->active_flag = 1;
				$state->save();
				DB::commit();//commit to database
				return redirect('states')->with('success', '¡Estado activado satisfactoriamente!');
			}
	}


	public function active_states_drop()
	{
		$states = DB::table('states')->where('active_flag', '=', 1)->orderBy('name','asc')->get();
        if ($states == null || $states->isEmpty()) {
            \Session::flash('error', 'No hay estados activos para mostrar');
        }
        return json_encode(["states"=>$states]);
	}

}