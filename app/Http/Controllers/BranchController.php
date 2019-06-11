<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var branch
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Branch $model)
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
		$branches = $this->model->paginate();

		return view('branches.index', compact('branches'));
	}

	/**
	 * This method return the list of all branches
	 * that must be show in combo box.
	 * 
	 */
	public function list()
	{
		$branches = $this->model->paginate();
		return view('products.create', compact('branches'));
	}
	public function list2()
	{
		$branches = $this->model->paginate();
		return view('products.edit', compact('branches'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('branches.create');
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

		return redirect()->route('branches.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$branch = $this->model->findOrFail($id);

		return view('branches.show', compact('branch'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$branch = $this->model->findOrFail($id);

		return view('branches.edit', compact('branch'));
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

		$branch = $this->model->findOrFail($id);
		$branch->update($inputs);

		return redirect()->route('branches.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('branches.index')->with('message', 'Item deleted successfully.');
	}
}
