<?php

namespace App\Http\Controllers;

use App\Order;
use App\Work;
use App\Material_work;
use App\State_work;
use App\Order_order_state;
use App\Client_contact;
use App\Client;
use App\Product;
use App\Order_state;
use App\Phone;
use App\Branch;
use App\Physical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controller\CoinController;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

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
		$ordersAux = DB::table('orders')->get();
		$order_states = new Order_state();
		$order_states = $order_states->where('active_flag', '1')->get();
		$orders = collect();

		foreach ($ordersAux as $order) { //get the name and de lastname of the physical clients.
			$owner = Client::where('id', $order->client_owner)->first();

			$active_works = Work::where('order_id', $order->id)->where('active_flag', 1)->get();
			if(Auth::user()->user_type_id == 1){//if the user is administrator
				$works = "Administrator, not check privileges";
			} else {
				$works = $this->only_works_view_permission($active_works);
			}
			if(!$works == null || !empty($works)) {
				$finished_works_count = 0;

				$priority_works = Work::where('order_id', $order->id)->where('priority', 1)->get(); //get the works with priority of the order

				if ($priority_works->count()) {
					$order->priority = 1;
				} else {
					$order->priority = 0;
				}

				$latest_work = Work::where('order_id', $order->id)->latest('approximate_date')->first(); //get the work
				$order->latest_color = $this->calculateColor($latest_work); //Set the color according to the delivery time
				$order->latest_time_left = $latest_work->time_left;

				$first_work = Work::where('order_id', $order->id)->orderBy('approximate_date', 'ASC')->first(); //get the work
				$order->first_color = $this->calculateColor($first_work); //Set the color according to the delivery time
				$order->first_time_left = $first_work->time_left;

				foreach ($active_works as $active_work) {
					$state_work = State_work::where('work_id', $active_work->id)->latest('date')->first();
					///return $active_work;
					//if the works are in state 2 (Entregado) or state 3 (Cancelado)
					if ($state_work->states_id == 2 || $state_work->states_id == 3) {
						$finished_works_count = $finished_works_count + 1;
					}
				}

				$active_works_count = count($active_works);
				if (is_nan($finished_works_count) || is_nan($active_works_count)) {
					$order->finished_percentage = "Error %";
				} else {
					$order->finished_percentage = round(($finished_works_count / $active_works_count) * 100);
				}

				if ($owner->type == 1) {
					$physical_client = Physical_client::where('client_id', $owner->id)->first();
					$order->client_owner_name = $owner->name . " " . $physical_client->lastname;
				} else {
					$order->client_owner_name = $owner->name;
				}
				$contact = Client::where('id', $order->client_contact)->first();

				$contact_physical = Physical_client::where('client_id', $contact->id)->first();
				$order->client_contact_name = $contact->name . " " . $contact_physical->lastname;
				$order->last_order_state_id = DB::table('order_order_states')->where('order_id', $order->id)->latest('date')->first()->order_states_id;
				$orders->push($order);
			}
		
		}

		$orders = $orders->sortBy('first_time_left');
		
		//return $orders;
		$user_type = Auth::user()->user_type_id; //get the user type.
		if ($user_type == 1) { //admin user
			return view('admin.orders.index', compact('orders', 'order_states'));
		} elseif ($user_type == 2) { //receptionist user
			return view('reception.orders.index', compact('orders', 'order_states'));
		} elseif ($user_type == 3) { //boss designer users
			return view('designer/orders/index', compact('orders', 'order_states'));
		} elseif ($user_type == 4) { //designer user
			return view('designer/orders/index', compact('orders', 'order_states'));
		} elseif ($user_type == 5) { //designer user
			return view('print/boss_print/orders/index', compact('orders', 'order_states'));
		}elseif ($user_type == 6) { //designer user
			return view('print/regular_print/orders/index', compact('orders', 'order_states'));
		}elseif ($user_type == 7) { //designer user
			return view('postProduction/orders/index', compact('orders', 'order_states'));
		}
	}

	/**
	 * According to the delivery time, assign a color for the delivery of the work.
	 *
	 * 
	 */
	private function calculateColor($work)
	{

		$entry_date = Carbon::parse($entry_date = Carbon::parse($work->entry_date)->format('Y-m-d')); //text to date and format
		$delivery_date = Carbon::parse($delivery_date = Carbon::parse($work->approximate_date)->format('Y-m-d')); //text to date and format

		$date_diff = $entry_date->diffInDays($delivery_date); //calculate the difference of days beetwen entry date and delivery date
		$work->days = $date_diff; //Borrar

		$actual_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->format('Y-m-d');
		$actual_date = Carbon::parse($actual_date); //text to date

		$time_left = $actual_date->diffInDays($delivery_date); //calculate the available time

		if ($delivery_date <= $actual_date) { //calculate the delay time
			$time_left = $actual_date->diffInDays($delivery_date);
			$time_left = $time_left * -1;
		}

		$work->time_left = $time_left; //Importante meter en la gráfica, lleva el tiempo restante y el de atraso

		$color = "default";
		if ($date_diff <= 2) { //less than 2 days
			$color = "red";
		} else if ($date_diff <= 3) { //3 days
			if ($time_left <= 2) {
				$color = "red";
			} else {
				$color = "yelow";
			}
		} else if ($date_diff <= 4) { //4 days
			if ($time_left <= 2) {
				$color = "red";
			} else if ($time_left <= 4) {
				$color = "yelow";
			}
		} else if ($date_diff % 2 == 0) { //even numbers
			$days_green = ($date_diff / 2) - 1;
			$days_yellow = $days_green;
			$days_red = 2;
			if ($time_left <= 2) {
				$color = "red";
			} else if ($time_left <= $days_yellow + $days_red) { //considerar si hay que poner <=
				$color = "yellow";
			} else {
				$color = "green";
			}
		} else { //odd numbers
			$days_green = ($date_diff - 1) / 2;
			$days_yellow = $days_green - 1;
			$days_red = 2;
			if ($time_left <= 2) {
				$color = "red";
			} else if ($time_left <= $days_yellow + $days_red) { //considerar si hay que poner solo <
				$color = "yellow";
			} else {
				$color = "green";
			}
		}
		return $color;
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
			return view('admin.orders.create', compact('dolarRate'));
		} else if($user_type == 2) {
			return view('reception.orders.create', compact('dolarRate'));
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


	public function addOrdersWorks(Request $request)
	{

		/*if($request->hasFile('avatar')){
			throw new \Exception("yes");
		} else {
			throw new \Exception("no");
		}
		$file_array = Input::file();
		foreach ($file_array as $key => $value) {
			// Your dynamic field name
			//throw new \Exception("key" . $key);
			throw new \Exception("value:" . $value);
		 }
		if($request->has('date0')){
			throw new \Exception("yey");
		} else {
			throw new \Exception("no:c");
		}
		$a = Input::get('data');
		if($request->hasFile('avatar')){
			throw new \Exception("yes");
		} else {
			throw new \Exception("no");
		}
		throw new \Exception(request('quotation_number', $default = null));*/
		$postData = Input::get('data');
		$orderData = $request->order;
		$worksData = $request->works;
		$userID = Auth::user()->id;
		$updatedData = false;

		DB::beginTransaction();
		$orderModel = new Order();
		$orderDecoded = json_decode($orderData);
		//return json_encode(["data" => $orderDecoded[0]->existOrder]);
		//throw new \Exception($orderDecoded[0]->client_owner);


		foreach ($orderDecoded as $order) {
			if ($order->existOrder == "-1") {
				if ($order->quotation_number == "-1") { //if it´s just whitespaces
					$order->quotation_number = null;
				} else {
					$orderModel->quotation_number = $order->quotation_number;
				}

				$orderModel->client_owner =  $order->owner;
				$orderModel->client_contact =  $order->contact;
				$orderModel->client_contact =  $order->contact;

				if ($order->order_advanced_payment == "-1") { //if it´s just whitespaces
					$order->order_advanced_payment = null;
				} else {
					$orderModel->advance_payment = $order->order_advanced_payment;
				}

				if ($order->order_total == "-1") { //if it´s just whitespaces
					$order->order_total = null;
				} else {
					$orderModel->total = $order->order_total;
				}

				$orderModel->exchange_rate =  $order->exchange_rate;
				$orderModel->coin_id = (($order->coin) + 1); //ATENTION, this is 
				//because de difference between the JS coin handle vs the databse coin handle.  
				$orderModel->branch_id = Auth::user()->branch_id;
				$orderModel->entry_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
				//$orderModel->state_id = 1;
				$orderModel->active_flag = 1;
				$orderModel->save();

				$orderID = $orderModel->id;

				$order_state_model = new Order_order_state();
				$order_state_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
				$order_state_model->order_states_id = 1; //En progreso order_state
				$order_state_model->order_id = $orderID;
				$order_state_model->user_id = $userID;
				$order_state_model->save();

				$order_log_model = new \App\Order_log();
				$order_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
				$order_log_model->attribute = "Estado";
				$order_log_model->value = "Orden creada según datos iniciales";
				$order_log_model->order_id = $orderID;
				$order_log_model->user_id = $userID;
				$order_log_model->save();
			} else {
				$updatedData = true;
				$orderID = $order->orderID;
				$this->updateOrder($order);
			}
		}

		$worksDecoded = json_decode($worksData);
		$workCounter = 0;
		$workFileCounter = 0;

		foreach ($worksDecoded as $work) {
			if ($work->existWork == "-1") { //if the work is a new one

				${'workModel' . $workCounter} = new Work();
				$workModel = ${'workModel' . $workCounter};
				//return json_encode(["data" => $work->date]);

				$workModel->entry_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
				$workModel->approximate_date = Carbon::createFromFormat('d/m/Y', $work->date);
				$workModel->priority = $work->priority;
				$workModel->observation = $work->observation;
				$workModel->product_id = $work->product;


				$workModel->active_flag = 1;
				$workModel->order_id =	$orderID;


				$workModel->save();

				$materialsArray = explode(",", $work->materials);

				$material_work_Model = new Material_work();
				foreach ($materialsArray as $materialWork) {
					if (!empty($materialWork)) {
						$material_work_Model->material_id = $materialWork;
						$material_work_Model->work_id = $workModel->id;
						$material_work_Model->save();
					}
				}

				$state_work_Model = new State_work();
				$state_work_Model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
				$state_work_Model->states_id = 1; //Inicio work state
				$state_work_Model->work_id = $workModel->id;
				$state_work_Model->user_id = $userID;
				$state_work_Model->save();

				$work_log_model = new \App\Works_log();
				$work_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
				$work_log_model->attribute = "Estado";
				$work_log_model->value = "Trabajo creado según datos iniciales";
				$work_log_model->work_id = $workModel->id;
				$work_log_model->user_id = $userID;
				$work_log_model->save();

				if ($request->hasFile('file' . $workFileCounter)) {
					$requestFile = $request->file('file' . $workFileCounter);
					$filename = pathinfo($requestFile->getClientOriginalName(), PATHINFO_FILENAME);
					$extension = pathinfo($requestFile->getClientOriginalName(), PATHINFO_EXTENSION);
					$fileUnique = $filename . "_" . $workModel->id .  '.' . $extension;
					$filesize = $requestFile->getClientSize();
					$requestFile->storeAs('public/workFiles', $fileUnique);

					$work_fileModel = new \App\Works_file();
					$work_fileModel->name = $fileUnique;
					$work_fileModel->size = $filesize;
					$work_fileModel->work_id = $workModel->id;
					$work_fileModel->active_flag = 1;
					$work_fileModel->save();

					$work_log_model = new \App\Works_log();
					$work_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
					$work_log_model->attribute = "Archivo de trabajo";
					$work_log_model->value = "Se ha adjuntado un nuevo archivo";
					$work_log_model->work_id = $workModel->id;
					$work_log_model->user_id = $userID;
					$work_log_model->save();
				}
			} else { //if the work already exists and needs an update
				$updatedData = true;
				if ($request->hasFile('file' . $workFileCounter)) {
					$requestFile = $request->file('file' . $workFileCounter);
					$this->updateWorksLogBasicInfo($work, $requestFile);
				} else {
					$requestFile = $request->file('file' . $workFileCounter);
					$this->updateWorksLogBasicInfo($work, null);
				}
			}
			$workFileCounter = $workFileCounter + 1;
		}

		DB::commit();

		if ($updatedData) {
			\Session::flash('success', '¡Orden actualizada satisfactoriamente!');
		} else {
			\Session::flash('success', '¡Orden registrada satisfactoriamente!');
		}
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
		//$order->state_id = 1;
		$order->branch_id = $request->dropBranch;
		$order->active_flag = 1;
		$order->save();

		return redirect()->route('orders')->with('message', 'Orden creada satisfactoriamente');
	}

	public function updateOrder($order)
	{
		$orderID = $order->orderID;
		$orderModel = \App\Order::where('id', $orderID)->first();

		if ($orderModel->quotation_number != $order->quotation_number) {
			if ($orderModel->quotation_number == "" || empty($orderModel->quotation_number)) {
				$quotation = "Se agregó el número de cotización " . $order->quotation_number;
			} else {
				$quotation = "El número de cotización con el antiguo valor de " . '"' . $orderModel->quotation_number
					. '"' . " fue actualizado a " . '"' . $order->quotation_number . '"';
			}
			if ($order->quotation_number == "-1") { //if the new value it´s just whitespaces
				$quotation = "El número de cotización " . $orderModel->quotation_number
					. " fue eliminado.";
				$orderModel->quotation_number = null;
			} else {
				$orderModel->quotation_number = $order->quotation_number;
			}
			$this->saveOrderLog("Número de cotización", $quotation, $orderID);
		}

		if ($orderModel->client_owner != $order->owner) {
			$oldOwner = $this->getClientData($orderModel->client_owner);
			$newOwner = $this->getClientData($order->owner);

			if ($oldOwner->type == "1") {
				$oldName = $oldOwner->name . ' ' . $oldOwner->lastname;
			} else {
				$oldName = $oldOwner->name;
			}

			if ($newOwner->type == "1") {
				$newName = $newOwner->name . ' ' . $newOwner->lastname;
			} else {
				$newName = $newOwner->name;
			}
			$owner = "La propiedad del trabajo fue transferido de su antiguo dueño " . $oldName .
				" a su nuevo dueño " . $newName;
			$orderModel->client_owner = $order->owner;
			$this->saveOrderLog("Cliente dueño", $owner, $orderID);
		}
		if ($orderModel->client_contact != $order->contact) {
			$oldContact = $this->getClientData($orderModel->client_contact);
			$newContact = $this->getClientData($order->contact);

			if ($oldContact->type == "1") {
				$oldName = $oldContact->name . ' ' . $oldContact->lastname;
			} else {
				$oldName = $oldContact->name;
			}

			if ($newContact->type == "1") {
				$newName = $newContact->name . ' ' . $newContact->lastname;
			} else {
				$newName = $newContact->name;
			}
			$contact = "El contacto del trabajo fue transferido de " . $oldName .
				" al nuevo contacto " . $newName;
			$orderModel->client_contact = $order->contact;
			$this->saveOrderLog("Cliente de contacto", $contact, $orderID);
		}
		if ($orderModel->total != $order->order_total) {
			if (($order->coin + 1) == 1) { //Colones, the +1 is neccesary because
				//the different implementations between coins at JS and coins at BD
				$coin = "₡";
			}
			if (($order->coin + 1) == 2) { //Dolars, the +1 is neccesary because
				//the different implementations between coins at JS and coins at BD
				$coin = "$";
			}

			if ($orderModel->total == "" || empty($orderModel->total)) {
				$total = "Se agregó el total de la orden, equivalente a " . $coin . $order->order_total;
			} else {
				$total = "El antiguo valor del total de la orden " .  $coin .
					$orderModel->total .
					" fue actualizado a " . $coin . $order->order_total;
			}
			if ($order->order_total == "-1") { //if the new value it´s just whitespaces
				$total = "El total de " . $coin .
					$orderModel->total . " fue removido.";
				$orderModel->total = null;
			} else {
				$orderModel->total = $order->order_total;
			}
			$this->saveOrderLog("Total de la orden", $total, $orderID);
		}
		if ($orderModel->advance_payment != $order->order_advanced_payment) {
			if (($order->coin + 1) == 1) { //Colones, the +1 is neccesary because
				//the different implementations between coins at JS and coins at BD
				$coin = "₡";
			}
			if (($order->coin + 1) == 2) { //Dolars, the +1 is neccesary because
				//the different implementations between coins at JS and coins at BD
				$coin = "$";
			}

			if ($orderModel->advance_payment == "" || empty($orderModel->advance_payment)) {
				$advance_payment = "Se agregó el adelanto de la orden, equivalente a " . $coin . $order->order_advanced_payment;
			} else {
				$advance_payment = "El antiguo valor del adelanto de la orden " . $coin .
					$orderModel->advance_payment .
					" fue actualizado a " . $coin . $order->order_advanced_payment;
			}
			if ($order->order_advanced_payment == "-1") { //if the new value it´s just whitespaces
				$total = "El adelanto de pago de " . $coin .
					$orderModel->advance_payment . " fue removido.";
				$orderModel->advance_payment = null;
			} else {
				$orderModel->advance_payment = $order->order_advanced_payment;
			}
			$this->saveOrderLog("Adelanto de la orden", $advance_payment, $orderID);
		}
		$orderModel->save();
		return;
	}

	/**
	 * 	Update the specified WORK in the database, wrtitting changes at log.
	 *
	 * @param [type] $work The work to update
	 * @param [type] $requestFile If the work has a new file, if null do nothing.
	 * @return void
	 */
	public function updateWorksLogBasicInfo($work, $requestFile)
	{
		$workModel = Work::where('id', $work->existWork)->first();
		$workID = $work->existWork;

		if ($workModel->priority != $work->priority) {
			if ($workModel->priority == "1") {
				$oldPriority = "Posee prioridad";
				$newPriority = "Sin prioridad";
			} else {
				$oldPriority = "Sin prioridad";
				$newPriority = "Posee prioridad";
			}
			$priority = "La prioridad con el antiguo valor de " . '"' . $oldPriority . '"' .
				" fue actualizada a " . '"' . $newPriority . '".' .
				$workModel->priority = $work->priority;
			$this->saveWorkLog("Prioridad", $priority, $workID);
		}

		$oldDate = Carbon::parse($workModel->approximate_date)->startOfDay();
		$newDate = Carbon::createFromFormat('d/m/Y', $work->date)->startOfDay();
		if ($oldDate->notEqualTo($newDate)) {
			$date = "La fecha de entrega con el antiguo valor de " . $oldDate->format('d/m/Y') .
				" fue actualizada a " . $newDate->format('d/m/Y');
			$workModel->approximate_date = $newDate;
			$this->saveWorkLog("Fecha de entrega aproximada", $date, $workID);
		}

		if ($workModel->observation != $work->observation) {
			$observation = "La observación fue actualizada.";
			$workModel->observation = $work->observation;
			$this->saveWorkLog("Observación", $observation, $workID);
		}

		if ($workModel->product_id != $work->product) {
			$oldName = \App\Product::where('id', $workModel->product_id)->first()->name;
			$newName = \App\Product::where('id', $work->product)->first()->name;
			$product = "El producto con el antiguo valor de " . '"' . $workModel->product_id . ". " .
				$oldName . '"' . " fue actualizado a " . '"' . $work->product . ". " .
				$newName . '".';
			$workModel->product_id = $work->product;
			$this->saveWorkLog("Producto", $product, $workID);
		}

		//throw new \Exception($work->materials[0] . $work->materials[1] . "workID" . $workID);
		$materialsArray = explode(",", $work->materials);

		$deleteOldMaterials = \App\Material_work::where('work_id', $workID)
			->whereNotIn('material_id', $materialsArray)->delete();

		//throw new \Exception($materialsArray[0] . $materialsArray[1] . "workID" . $workID);

		foreach ($materialsArray as $materialWork) {
			if (!empty($materialWork)) {
				$material_work_Model = \App\Material_work::where('work_id', $workID)
					->where('material_id', $materialWork)->first();
				//throw new \Exception($material_work_Model . "workID" . $workID);
				if (empty($material_work_Model)) {
					$insert_material_model = new \App\Material_work();
					$insert_material_model->material_id = $materialWork;
					$insert_material_model->work_id = $workID;
					$insert_material_model->save();
				}
			}
		}
		$workModel->save();

		if ($requestFile != null) {
			$file = \App\Works_file::where('work_id', $workID)->first();
			if ($file != null && !empty($file)) {
				if (\Storage::disk('local')->exists('public/workFiles/' . $file->name)) {
					$deletedFile = \App\Works_file::where('id', $file->id)->delete();
					//throw new \Exception($deletedFile . $file->name);
					\Storage::disk('local')->delete('public/workFiles/' . $file->name);

					$work_log_model = new \App\Works_log();
					$work_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
					$work_log_model->attribute = "Archivo de trabajo";
					$work_log_model->value = "Se ha eliminado un archivo de trabajo";
					$work_log_model->work_id = $workID;
					$work_log_model->user_id = Auth::user()->id;
					$work_log_model->save();
				}
			}
			$filename = pathinfo($requestFile->getClientOriginalName(), PATHINFO_FILENAME);
			$extension = pathinfo($requestFile->getClientOriginalName(), PATHINFO_EXTENSION);
			$fileUnique = $filename . "_" . $workID .  '.' . $extension;
			$filesize = $requestFile->getClientSize();
			$requestFile->storeAs('public/workFiles', $fileUnique);

			$work_fileModel = new \App\Works_file();
			$work_fileModel->name = $fileUnique;
			$work_fileModel->size = $filesize;
			$work_fileModel->work_id = $workID;
			$work_fileModel->active_flag = 1;
			$work_fileModel->save();

			$work_log_model = new \App\Works_log();
			$work_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
			$work_log_model->attribute = "Archivo de trabajo";
			$work_log_model->value = "Se ha adjuntado un nuevo archivo";
			$work_log_model->work_id = $workID;
			$work_log_model->user_id = Auth::user()->id;
			$work_log_model->save();
		}
		return;
	}

	/**
	 * Creates a new log at work_log with the determined values
	 * @param [type] $attribute The name of the attribute to write
	 * @param [type] $value The value of the attribute
	 * @param [type] $workID The id of the work to update
	 * @return void
	 */
	public function saveWorkLog($attribute, $value, $workID)
	{
		$work_log_model = new \App\Works_log();
		$work_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
		$work_log_model->attribute = $attribute;
		$work_log_model->value = $value;
		$work_log_model->work_id = $workID;
		$work_log_model->user_id =  Auth::user()->id;
		$work_log_model->save();
	}

	/**
	 * Creates a new log at work_log with the determined values
	 * @param [type] $attribute The name of the attribute to write
	 * @param [type] $value The value of the attribute
	 * @param [type] $orderID The id of the order to update
	 * @return void
	 */
	public function saveOrderLog($attribute, $value, $orderID)
	{
		$order_log_model = new \App\Order_log();
		$order_log_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
		$order_log_model->attribute = $attribute;
		$order_log_model->value = $value;
		$order_log_model->order_id = $orderID;
		$order_log_model->user_id =  Auth::user()->id;
		$order_log_model->save();
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
		\Session::put('errorOrigin', " editanto la orden");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "orders");

		$order = $this->model->find($id);

		if ($order == null) {
			throw new \Exception('Error en editar la orden con el id:' . $id
				. " en el método OrderController@edit");
		} else {

			$owner = $this->getClientData($order->client_owner);
			$contact = $order->client_contact;
			$works = \App\Work::where('order_id', $order->id)->get();

			if (Auth::user()->user_type_id != 1) { //if the user is not an admin user
				$works = $this->only_works_view_permission($works);
			}

			foreach ($works as $work) {
				$work->materials = Material_work::where('work_id', $work->id)->get();
				$work->product_name = \App\Product::where('id', $work->product_id)->first()->name;
				$file = \App\Works_file::where('work_id', $work->id)->first();
				//$work->file_id = "aaa";
				if ($file != null && !empty($file)) {
					$work->file_id = $file->id;
				}
			}

			//return compact('order', 'owner', 'contact', 'works');
			//return $owner;
			$user_type = Auth::user()->user_type_id;
			if ($user_type == 1) { //admin user
                return view('admin.orders.edit', compact('order', 'owner', 'contact', 'works'));
            }else if ($user_type == 2) { //reception user
				return view('reception.orders.edit', compact('order', 'owner', 'contact', 'works'));
			} else if ($user_type == 3 || $user_type == 4) { //boss designer and designer user
				return view('designer/orders/edit', compact('order', 'owner', 'contact', 'works'));
			} else if ($user_type == 5) { //boss designer and designer user
				return view('print/boss_print/orders/edit', compact('order', 'owner', 'contact', 'works'));
			} else if ($user_type == 6) { //boss designer and designer user
				return view('print/regular_print/orders/edit', compact('order', 'owner', 'contact', 'works'));
			} elseif ($user_type == 7) { //designer user
				return view('postProduction/orders/edit', compact('order', 'owner', 'contact', 'works'));
			}
		}
	}

	public function only_works_view_permission($works)
	{
		$works_view = [];
		$view_states = DB::table('state_user_types') //get the list of states that the user can see
			->where('user_types_id', Auth::user()->user_type_id)
			->where('view_state', 1)->get();

		foreach ($works as $work) {
			$state_works = DB::table('state_work') //get the state with the last date of an work
				->where('work_id', '=', $work->id)
				->orderby('date', 'DESC')->first();

			$work->work_state = $state_works->states_id; //= $states->id;//podría dejarse "= $state_works->states_id" si se borra lo de arriba

			foreach ($view_states as $view_state) { //add to array only the works that the user can see
				if ($work->work_state == $view_state->states_id) {
					array_push($works_view, $work);
				}
			}
		}
		return $works_view;
	}

	public function downloadFile($id)
	{
		$file = \App\Works_file::where('id', $id)->first();
		if (\Storage::disk('local')->exists('public/workFiles/' . $file->name)) {
			return response()->download(storage_path("app/public/workFiles/{$file->name}"));
		}
		return response();
	}

	public function getClientData($client_id)
	{
		$client = \App\Client::where('id', $client_id)->first();
		if ($client->type == 1) { //physical client, fill model attributes) 
			$phisClient = \App\Physical_client::where('client_id', $client->id)->first();
			$client->lastname = $phisClient->lastname;
			$client->second_lastname = $phisClient->second_lastname;
			$client->client_table_id = $phisClient->client_id;
		}
		if ($client->type == 2) { //juridical client, fill model attributes
			$jurClient = \App\Juridical_client::where('client_id', $client->id)->first();
			$client->client_table_id = $jurClient->client_id;
		}
		$client->phones = $client->phones()->where('active_flag', 1)->first();
		$client->emails = $client->emails()->where('active_flag', 1)->first();
		return $client;
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
		$clients = DB::table('clients') //get all the clients order by id
			->where('active_flag', '=', 1)
			->orderBy('id', 'asc')->get();

		foreach ($clients as $client) {
			if ($client->identification == null) {
				$client->identification = "No posee";
			} else {
				$client->identification = $client->identification;
			}
			$client->phone = $this->getPhone($client);
			$client->email = $this->getEmail($client);

			if ($client->type == 1) { //extracts the full name if the client are physical 
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
	private function getPhone($client)
	{
		$phone = DB::table('phones')
			->where('client_id', '=', $client->id)
			->first();
		$phone_number = "No posee";
		if ($phone == null) {
			$phone_number = "No posee";
		} else {
			$phone_number = $phone->number;
		}
		return $phone_number; //return the phone number of the client
	}

	/**
	 * 
	 * Get the email of a specific client
	 * 
	 */
	private function getEmail($client)
	{
		$email = DB::table('emails')
			->where('client_id', '=', $client->id)
			->first();
		$email_client = "No posee";
		if ($email == null) {
			$email_client = "No posee";
		} else {
			$email_client = $email->email;
		}
		return $email_client; //return the email of the client
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

	public function ajax_fill_contacts($id)
	{
		$contacts = Client_contact::where('client_id', $id)
			->where('active_flag', 1)->get();

		foreach ($contacts as $contact) { //get the name of the contact client.
			$client = Client::where('id', $contact->contact_id)->first();
			$physical_client = Physical_client::where('client_id', $contact->contact_id)->first();
			$contact->identification = $client->identification;
			$contact->contact_name = $client->name . " " . $physical_client->lastname . " " . $physical_client->second_lastname;
			//$contact->phone = $this->getPhone($contact->contact_id);
			//$contact->email = $this->getEmail($contact->contact_id);
			//$contact->client_owner = $id; 
		}

		if ($contacts == null || $contacts->isEmpty()) {
			//Flash::message("No hay contactos para mostrar");
		}
		return json_encode(["contacts" => $contacts]);
	}



	/**
	 * This method generate an specific detail order report
	 */
	public function selectOrder($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " creando reporte orden");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "orders");
		$order = $this->model->find($id);
		$client = Client::where('id', $order->client_owner)->first();
		if ($client->type == 1) {
			$phisClient = Physical_client::where('client_id', $order->client_owner)->first();
			$order->client_owner = $client->name . " " . $phisClient->lastname . " " . $phisClient->second_lastname;
		} else {
			$order->client_owner = $client->name;
		}
		$order->branch_id = (Branch::where('id', $order->branch_id)->first())->name;
		$works = Work::where('order_id', $id)->get();
		foreach ($works as $work) {
			$work->product_id = (Product::where('id', $work->product_id)->first())->name;
		}
		$order->works = $works;
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML(view('admin/reports/reportDetailsOrder', compact('order'))->render());
		return $pdf->stream('detalleOrden' . $order->id . '.pdf');
	}

	function changeOrderWorksState($orderID, $stateID)
	{

		DB::beginTransaction();

		$userID = Auth::user()->id;

		$order_state_model = new Order_order_state();
		$order_state_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
		$order_state_model->order_states_id = $stateID; //The state that the user choosed
		$order_state_model->order_id = $orderID;
		$order_state_model->user_id = $userID;
		$order_state_model->save();

		$orderWorks = \App\Work::where('order_id', $orderID)->get();

		foreach ($orderWorks as $work) {
			$state_work_Model = new State_work();
			$state_work_Model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
			$state_work_Model->states_id = $stateID; //Inicio work state
			$state_work_Model->work_id = $work->id;
			$state_work_Model->user_id = $userID;
			$state_work_Model->save();
			$workController = new \App\Http\Controllers\WorkController(new \App\Work());
			$workController->notifyToUsers($work->id, $stateID);
		}

		DB::commit();
		return json_encode(["message" => "¡Estado de la Orden y los Trabajos actualizados satisfactoriamente!"]);
	}
}
