<?php

namespace App\Http\Controllers;

use App\State_work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class State_workController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var state_work
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(State_work $model)
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
		$state_works = $this->model->paginate();

		return view('state_works.index', compact('state_works'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('state_works.create');
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

		return redirect()->route('state_works.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$state_work = $this->model->findOrFail($id);
		
		return view('state_works.show', compact('state_work'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$state_work = $this->model->findOrFail($id);
		
		return view('state_works.edit', compact('state_work'));
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

		$state_work = $this->model->findOrFail($id);		
		$state_work->update($inputs);

		return redirect()->route('state_works.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('state_works.index')->with('message', 'Item deleted successfully.');
	}
}