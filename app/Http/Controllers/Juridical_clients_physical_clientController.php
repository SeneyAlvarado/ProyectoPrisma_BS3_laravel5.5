<?php

namespace App\Http\Controllers;

use App\Juridical_clients_physical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Juridical_clients_physical_clientController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var juridical_clients_physical_client
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Juridical_clients_physical_client $model)
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
		$juridical_clients_physical_clients = $this->model->paginate();

		return view('juridical_clients_physical_clients.index', compact('juridical_clients_physical_clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('juridical_clients_physical_clients.create');
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

		return redirect()->route('juridical_clients_physical_clients.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$juridical_clients_physical_client = $this->model->findOrFail($id);
		
		return view('juridical_clients_physical_clients.show', compact('juridical_clients_physical_client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$juridical_clients_physical_client = $this->model->findOrFail($id);
		
		return view('juridical_clients_physical_clients.edit', compact('juridical_clients_physical_client'));
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

		$juridical_clients_physical_client = $this->model->findOrFail($id);		
		$juridical_clients_physical_client->update($inputs);

		return redirect()->route('juridical_clients_physical_clients.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('juridical_clients_physical_clients.index')->with('message', 'Item deleted successfully.');
	}
}