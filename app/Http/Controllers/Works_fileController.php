<?php

namespace App\Http\Controllers;

use App\Works_file;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Works_fileController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var works_file
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Works_file $model)
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
		$works_files = $this->model->paginate();

		return view('works_files.index', compact('works_files'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('works_files.create');
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

		return redirect()->route('works_files.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$works_file = $this->model->findOrFail($id);
		
		return view('works_files.show', compact('works_file'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$works_file = $this->model->findOrFail($id);
		
		return view('works_files.edit', compact('works_file'));
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

		$works_file = $this->model->findOrFail($id);		
		$works_file->update($inputs);

		return redirect()->route('works_files.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('works_files.index')->with('message', 'Item deleted successfully.');
	}
}