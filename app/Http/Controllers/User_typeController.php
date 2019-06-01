<?php

namespace App\Http\Controllers;

use App\User_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class User_typeController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var user_type
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(User_type $model)
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
		$user_types = $this->model->paginate();

		return view('user_types.index', compact('user_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user_types.create');
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

		return redirect()->route('user_types.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user_type = $this->model->findOrFail($id);
		
		return view('user_types.show', compact('user_type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user_type = $this->model->findOrFail($id);
		
		return view('user_types.edit', compact('user_type'));
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

		$user_type = $this->model->findOrFail($id);		
		$user_type->update($inputs);

		return redirect()->route('user_types.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('user_types.index')->with('message', 'Item deleted successfully.');
	}
}