<?php

namespace App\Http\Controllers;

use App\Works_log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Works_logController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var works_log
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Works_log $model)
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
		$works_logs = $this->model->paginate();

		return view('works_logs.index', compact('works_logs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('works_logs.create');
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

		return redirect()->route('works_logs.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$works_log = $this->model->findOrFail($id);
		
		return view('works_logs.show', compact('works_log'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$works_log = $this->model->findOrFail($id);
		
		return view('works_logs.edit', compact('works_log'));
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

		$works_log = $this->model->findOrFail($id);		
		$works_log->update($inputs);

		return redirect()->route('works_logs.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('works_logs.index')->with('message', 'Item deleted successfully.');
	}
}