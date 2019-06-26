<?php

namespace App\Http\Controllers;

use App\Order_state;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Order_stateController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var order_state
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Order_state $model)
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
		$order_states = $this->model->paginate();

		return view('order_states.index', compact('order_states'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('order_states.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$inputs = $request->all();
		$this->model->create($inputs);

		return redirect()->route('order_states.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$order_state = $this->model->findOrFail($id);
		
		return view('order_states.show', compact('order_state'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order_state = $this->model->findOrFail($id);
		
		return view('order_states.edit', compact('order_state'));
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

		$order_state = $this->model->findOrFail($id);		
		$order_state->update($inputs);

		return redirect()->route('order_states.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('order_states.index')->with('message', 'Item deleted successfully.');
	}
}