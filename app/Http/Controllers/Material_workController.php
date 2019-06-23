<?php

namespace App\Http\Controllers;

use App\Material_work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Material_workController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var material_work
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Material_work $model)
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
		$material_works = $this->model->paginate();

		return view('material_works.index', compact('material_works'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('material_works.create');
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

		return redirect()->route('material_works.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$material_work = $this->model->findOrFail($id);
		
		return view('material_works.show', compact('material_work'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$material_work = $this->model->findOrFail($id);
		
		return view('material_works.edit', compact('material_work'));
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

		$material_work = $this->model->findOrFail($id);		
		$material_work->update($inputs);

		return redirect()->route('material_works.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('material_works.index')->with('message', 'Item deleted successfully.');
	}
}