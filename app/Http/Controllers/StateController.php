<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
		return view('admin/states/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$state = new State();
		$state->name=$request->name;
		$state->description=$request->description;
		$state->active_flag = 1;
		$state->save();

		return redirect('estados')->with('message', 'El estado se guardó correctamente');
	}

	/**
	 * Display the specified state.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$state = $this->model->findOrFail($id);
		
		return view('admin/states/index', compact('states'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$state = $this->model->findOrFail($id);
		
		return view('admin/states/edit', compact('state'));
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

		$state = $this->model->findOrFail($id);		
		$state->update($inputs);

		return redirect('estados')->with('message', 'Los cambios se guardaron exitosamente');
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

		return redirect('estados')->with('message', 'El estado se eliminó correctamente.');
	}
}