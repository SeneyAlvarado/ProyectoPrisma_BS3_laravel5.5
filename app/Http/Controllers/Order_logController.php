<?php

namespace App\Http\Controllers;

use App\Order_log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Order_logController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var order_log
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Order_log $model)
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
		$order_logs = $this->model->paginate();

		return view('order_logs.index', compact('order_logs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('order_logs.create');
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

		return redirect()->route('order_logs.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$order_log = $this->model->findOrFail($id);
		
		return view('order_logs.show', compact('order_log'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order_log = $this->model->findOrFail($id);
		
		return view('order_logs.edit', compact('order_log'));
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

		$order_log = $this->model->findOrFail($id);		
		$order_log->update($inputs);

		return redirect()->route('order_logs.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('order_logs.index')->with('message', 'Item deleted successfully.');
	}
}