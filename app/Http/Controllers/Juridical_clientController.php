<?php

namespace App\Http\Controllers;

use App\Juridical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Juridical_clientController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var juridical_client
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Juridical_client $model)
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
		$juridical_clients = $this->model->paginate();

		return view('juridical_clients.index', compact('juridical_clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('juridical_clients.create');
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

		return redirect()->route('juridical_clients.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$juridical_client = $this->model->findOrFail($id);
		
		return view('juridical_clients.show', compact('juridical_client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$juridical_client = $this->model->findOrFail($id);
		
		return view('juridical_clients.edit', compact('juridical_client'));
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

		$juridical_client = $this->model->findOrFail($id);		
		$juridical_client->update($inputs);

		return redirect()->route('juridical_clients.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('juridical_clients.index')->with('message', 'Item deleted successfully.');
	}
}