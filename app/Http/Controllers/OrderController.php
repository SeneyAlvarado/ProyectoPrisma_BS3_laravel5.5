<?php

namespace App\Http\Controllers;

use App\Order;
use App\Work;
use App\Material_work;
use App\State_work;
use App\Client;
use App\Phone;
use App\Physical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controller\CoinController;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

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
		foreach ($orders as $order) { //get the name and de lastname of the physical clients.
			$owner = Client::where('id', $order->client_owner)->first();

			if ($owner->type == 1) {
				$physical_client = Physical_client::where('client_id', $owner->id)->first();
				$order->client_owner_name = $owner->name . " " . $physical_client->lastname;
			} else {
				$order->client_owner_name = $owner->name;
			}
			$contact = Client::where('id', $order->client_contact)->first();

			$contact_physical = Physical_client::where('client_id', $contact->id)->first();
			$order->client_contact_name = $contact->name . " " . $contact_physical->lastname;
		}
		$user_type = Auth::user()->user_type_id; //get the user type.
		if ($user_type == 1) { //admin user
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
		$dolarRate = app('App\Http\Controllers\CoinController')->dolarExchangeRate();
		$user_type = Auth::user()->user_type_id;
		if ($user_type == 1) { //admin user
			return view('admin.orders.create',compact('dolarRate'));
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
		//$request->input('student_number_in_class');
		return $request->all();;
		$request->file('avatar')->store('public');
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


	public function addOrdersWorks()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando la orden y los trabajos");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "orders");

		$postData = Input::get('data');
		$orderData = $postData[0];
		$worksData = $postData[1];
		$userID = Auth::user()->id;
		
		DB::beginTransaction();

		$orderModel = new Order();
		$orderDecoded = json_decode($orderData);

		foreach ($orderDecoded as $order) {
			
			if($order->quotation_number == "-1"){//if it´s just whitespaces
				$order->quotation_number = null;
			} else {
				$orderModel->quotation_number = $order->quotation_number;
			}

			$orderModel->client_owner =  $order->owner;
			$orderModel->client_contact =  $order->contact;
			$orderModel->client_contact =  $order->contact;

			if($order->order_advanced_payment == "-1"){//if it´s just whitespaces
				$order->order_advanced_payment = null;
			} else {
				$orderModel->advance_payment = $order->order_advanced_payment;
			}

			if($order->order_total == "-1"){//if it´s just whitespaces
				$order->order_total = null;
			} else {
				$orderModel->total = $order->order_total;
			}

			$orderModel->exchange_rate =  $order->exchange_rate;
			$orderModel->coin_id =  (($order->coin)+1);
			$orderModel->branch_id = Auth::user()->branch_id; 
			$orderModel->entry_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
			$orderModel->state_id = 1;
			$orderModel->active_flag = 1;
			$orderModel->save();
		}

		$orderID = $orderModel->id;
		
		$worksDecoded = json_decode($worksData);
		$workCounter = 0;

		foreach ($worksDecoded as $work) {
			${'workModel' . $workCounter} = new Work();
			$workModel = ${'workModel' . $workCounter};
			//return json_encode(["data" => $work->date]);
			
			$workModel->entry_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
			$workModel->approximate_date = Carbon::createFromFormat('d/m/Y', $work->date);
			$workModel->priority = $work->priority;
			$workModel->observation = $work->observation;
			$workModel->product_id = $work->product;

		
			$workModel->user_id = $userID; 
			$workModel->active_flag = 1;
			$workModel->order_id =	$orderID;

			
			$workModel->save();

			$material_work_Model = new Material_work();
			$materialsArray = explode("," , $work->materials);
			foreach ($materialsArray as $materialWork) {
				$material_work_Model->material_id = $materialWork;
				$material_work_Model->work_id = $workModel->id;
				$material_work_Model->save();
			}

			$state_work_Model = new State_work();
			$state_work_Model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
			$state_work_Model->states_id = 1;
			$state_work_Model->work_id = $workModel->id;
			$state_work_Model->user_id = $userID;
			$state_work_Model->save();
		}

		DB::commit();

		\Session::flash('success', 'Orden registrada satisfactoriamente!');
		return json_encode(["data" => "successRequest"]);
		//$works = json_decode($works);
		//$order = json_decode($order);
		//dd("a")
		//return response()->json(['success'=>'Got Simple Ajax Request.']);
		//return json_encode(["data"=>$request->all());
		//$request->input('student_number_in_class');
		return $request->all();
		$request->file('avatar')->store('public');
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

	/**
	 * 
	 * Get all the clients in the systema with their pohone number and email.
	 * 
	 * */
	public function ajax_list_clients()
	{
		$clients = DB::table('clients')//get all the clients order by id
			->where('active_flag', '=', 1)
			->orderBy('id', 'asc')->get();

		foreach ($clients as $client) {
			if($client->identification == null) {
				$client->identification = "No posee";
			} else {
				$client->identification = $client->identification;
			}
			$client->phone = $this->getPhone($client);
			$client->email = $this->getEmail($client);

			if ($client->type == 1) {//extracts the full name if the client are physical 
				$phisClient = Physical_client::where('client_id', $client->id)->first();
				$client->name = $client->name . " " . $phisClient->lastname . " " . $phisClient->second_lastname;
				
			}
		}
		if ($clients == null || $clients->isEmpty()) {
			Flash::message("No hay clientes para mostrar");
		}
		return json_encode(["clients" => $clients]);
	}


	/**
	 * 
	 * Get the phone number of a specific client
	 * 
	 */
	private function getPhone($client){
		$phone = DB::table('phones')
		->where('client_id', '=', $client->id)
		->first();
		$phone_number;
		if($phone == null ) {
			$phone_number = "No posee";
		} else {
			$phone_number = $phone->number;
		}
		return $phone_number;//return the phone number of the client
	}

	/**
	 * 
	 * Get the email of a specific client
	 * 
	 */
	private function getEmail($client){
		$email = DB::table('emails')
		->where('client_id', '=', $client->id)
		->first();
		$email_client;
		if($email == null ) {
			$email_client = "No posee";
		} else {
			$email_client = $email->email;
		}
		return $email_client;//return the email of the client
	}

	public function ajax_list_materials()
	{
		$materials = DB::table('materials')
			->where('active_flag', '=', 1)
			->where('branch_id', '=', Auth::user()->branch_id)
			->orderBy('id', 'asc')->get();

		if ($materials == null || $materials->isEmpty()) {
			Flash::message("No hay materiales para mostrar");
		}
		return json_encode(["materials" => $materials]);
	}



	/**
       * This method generate an specific order report
       */
      public function selectOrder($id)
      {
            //custom message if this methods throw an exception
		\Session::put('errorOrigin', " creando reporte orden");	

		//custom route to REDIRECT redirect('x') if there's an error
        \Session::put('errorRoute', "orders");
			$order=$this->model->find($id);
			$order->works=Work::where('order_id', $id)->get();
            $pdf = \App::make('dompdf.wrapper');
          	$pdf->loadHTML(view('admin/reports/reportDetailsOrder', compact('order'))->render()); 
            return $pdf->stream('detalleOrden'.$order->id.'.pdf');
      }
}

 
/* Imprime en Pantalla el Resultado de Valor de COMPRA Y VENTA*/
/* Pueden utilizar la variable llamada $valor( que es una estructura Arreglo ) con la posicion de compra y venta en sus aplicaciones como gusten. */
