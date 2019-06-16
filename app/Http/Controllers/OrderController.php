<?php

namespace App\Http\Controllers;

use App\Order;
use App\Client;
use App\Phone;
use App\Physical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class OrderController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var order
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Order $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the orders.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = DB::table('orders')
		->join('clients', 'orders.client_contact', 'clients.id')
		->select('orders.approximate_date as approximate_date',
		'orders.active_flag as active_flag',
		'orders.branch_id as branch_id',
		'orders.client_contact as client_contact',
		'orders.client_owner as client_owner',
		'orders.entry_date as entry_date',
		'orders.id as id',
		'orders.quotation_number as quotation_number',
		'orders.state_id as state_id',
		'clients.id as client_id',
		'clients.name as name',
		'clients.type as client_type')
		->get();
		$physical_client;
		foreach($orders as $order){//get the name and de lastname of the physical clients.
			if($order->client_type == 1) {
				$physical_client = Physical_client::where('id', $order->client_owner)->First();
				$order->name = $order->name . " " . $physical_client->lastname  ;
			}

		}

		$user_type = Auth::user()->user_type_id;//get the user type.
		if($user_type == 1){//admin user
			return view('admin.orders.index', compact('orders'));
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('orders.create');
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

		return redirect()->route('orders.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$order = $this->model->findOrFail($id);
		
		return view('orders.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order = $this->model->findOrFail($id);
		
		return view('orders.edit', compact('order'));
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

		$order = $this->model->findOrFail($id);		
		$order->update($inputs);

		return redirect()->route('orders.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('orders.index')->with('message', 'Item deleted successfully.');
	}

	
}