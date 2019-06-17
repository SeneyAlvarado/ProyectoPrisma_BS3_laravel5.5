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
		->get();
		foreach($orders as $order){//get the name and de lastname of the physical clients.
			$owner = Client::where('id', $order->client_owner)->first();
			
			if($owner->type == 1) {
				$physical_client = Physical_client::where('client_id', $owner->id)->first();
				$order->client_owner_name = $owner->name . " " . $physical_client->lastname;
			} else {
				$order->client_owner_name = $owner->name;
			}
			$contact = Client::where('id', $order->client_contact)->first();
			
			$contact_physical = Physical_client::where('client_id', $contact->id)->first();
			$order->client_contact_name = $contact->name . " " . $contact_physical->lastname;
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