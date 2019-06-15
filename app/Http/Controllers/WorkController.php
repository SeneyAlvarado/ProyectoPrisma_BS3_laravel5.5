<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class WorkController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var work
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Work $model)
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
		$works = $this->model->paginate();

		return view('works/index', compact('works'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('works.create');
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

		return redirect()->route('works.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$work = $this->model->findOrFail($id);
		
		return view('works.show', compact('work'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$work = $this->model->findOrFail($id);
		
		return view('works.edit', compact('work'));
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

		$work = $this->model->findOrFail($id);		
		$work->update($inputs);

		return redirect()->route('works.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('works.index')->with('message', 'Item deleted successfully.');
	}
}