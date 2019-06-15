<?php

namespace App\Http\Controllers;

use App\Physical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Physical_clientController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var physical_client
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Physical_client $model)
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
		$physical_clients = $this->model->paginate();

		return view('physical_clients.index', compact('physical_clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('physical_clients.create');
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

		return redirect()->route('physical_clients.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$physical_client = $this->model->findOrFail($id);
		
		return view('physical_clients.show', compact('physical_client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$physical_client = $this->model->findOrFail($id);
		
		return view('physical_clients.edit', compact('physical_client'));
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

		$physical_client = $this->model->findOrFail($id);		
		$physical_client->update($inputs);

		return redirect()->route('physical_clients.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('physical_clients.index')->with('message', 'Item deleted successfully.');
	}
}