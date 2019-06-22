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
use Carbon\Carbon;

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
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.orders.create');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//return $request;
		$order = new Order();
		$order->entry_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
		$order->approximate_date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
		$order->quotation_number = $request->payment;
		$order->client_owner = $request->owner_client;
		$order->client_contact = $request->contact_client;
		$order->state_id = 1;
		$order->branch_id = $request->dropBranch;
		$order->active_flag = 1;
		$order->save();

		return redirect()->route('orders')->with('message', 'Orden creada satisfactoriamente');
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

	public function ajax_list_clients(){
		$clients=DB::table('clients')
		->where('active_flag', '=', 1)
		->orderBy('name','desc')->get();

		foreach($clients as $client){
			if($client->type == 1){
				$phisClient = Physical_client::where('client_id', $client->id)->first();
				$client->lastname = $phisClient->lastname;
				$client->second_lastname = $phisClient->second_lastname;		
			}
		}
		if ($clients == null || $clients->isEmpty()) {
			Flash::message("No hay clientes para mostrar");
		}
		return json_encode(["clients"=>$clients]);
		
	}

	public function ajax_list_materials(){
		$materials=DB::table('materials')
		->where('active_flag', '=', 1)
		->where('branch_id', '=', Auth::user()->branch_id)
		->orderBy('id','asc')->get();

		if ($materials == null || $materials->isEmpty()) {
			Flash::message("No hay materiales para mostrar");
		}
		return json_encode(["materials"=>$materials]);
		
	}
	
}