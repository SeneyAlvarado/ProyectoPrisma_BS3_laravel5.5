<?php

namespace App\Http\Controllers;

use App\Material_work;
use App\Product;
use App\Work;
use App\State;
use App\State_work;
use App\Client;
use App\Physical_client;
use App\User;
use App\Works_file;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Spipu\Html2Pdf\Html2pdf;
use NahidulHasan\Html2pdf\Facades\Pdf;
use Carbon\Carbon;


class WorkController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var work
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Work $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the works.
	 *
	 * @return Response
	 */
	public function index()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando los trabajos");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");

		$works = DB::table('works')
		->join('orders', 'works.order_id', 'orders.id')
		->select('works.id as work_id',
		'works.priority as priority',
		'works.approximate_date as approximate_date',
		'works.entry_date as entry_date',
		'works.active_flag as active_flag',
		'works.designer_id as designer_id',
		'orders.client_owner as client_owner')
		->orderBy('priority', 'DESC')->orderBy('approximate_date', 'ASC')
		->get();

		$user_type = Auth::user()->user_type_id;
		if($user_type == 1) {//admin user
			return $this->indexAdmin($works);
		} else if($user_type == 2){ //reception user
			return $this->indexReception($works);
		} else if($user_type == 3){//designer user 
			return $this->indexBossDesigner($works);
		}
	}

	/**
	 * Return the list of works for admin user
	 *
	 * 
	 */
	private function indexAdmin($works){
		$work_states = new State();
		$work_states = $work_states->where('active_flag', '1')->get();

		foreach($works as $work){//get the name and de lastname of the physical clients.
			$owner = Client::where('id', $work->client_owner)->first();
			
			if($owner->type == 1) {
				$physical_client = Physical_client::where('client_id', $owner->id)->first();
				$work->client_name = $owner->name . " " . $physical_client->lastname;
			} else {
				$work->client_name = $owner->name;
			}
		}

		$color = "default";
		foreach($works as $work) {//
			$state_works=DB::table('state_work')
			->where('work_id', '=', $work->work_id)
			->orderby('date','DESC')->first();

			$states=DB::table('states')
			->where('id', '=', $state_works->states_id)
			->first();

			$work->work_state = $states->id;

			$work->color = $this->calculateColor($work);
		}
		//return $works;
		//return $work_states;
		$user_type = Auth::user()->user_type_id;
			if($user_type == 1){//admin user
				return view('admin.works.index', compact('works', 'work_states'));
			} else if($user_type == 3){//designer user
				return view('designer/boss_designer/works/index', compact('works', 'work_states'));
		return view('admin.works.index', compact('works', 'work_states'));
	}
}

	/**
	 * Return the list of works for an specific user
	 *
	 * 
	 */
	private function indexReception($works) {

		$works_view = [];
		$editStates = [];
		$work_states = new State();
		$work_states = $work_states->where('active_flag', '1')->get();

		$view_states = DB::table('state_user_types') //get the list of states that the user can see
		->where('user_types_id', Auth::user()->user_type_id)
		->where('view_state', 1)->get();

		$edit_states = DB::table('state_user_types') //get the list of states that the user can edit
		->where('user_types_id', Auth::user()->user_type_id)
		->where('edit_state', 1)->get();

		foreach($works as $work) {
			$state_works=DB::table('state_work') //get the state with the last date of an work
			->where('work_id', '=', $work->work_id)
			->orderby('date','DESC')->first();

			$work->work_state = $state_works->states_id;//= $states->id;//podría dejarse "= $state_works->states_id" si se borra lo de arriba

			foreach($view_states as $view_state) {//add to array only the works that the user can see
				if($work->work_state == $view_state->states_id){
					array_push($works_view, $work);
				}
			}

			foreach($works_view as $work_view) { //get the full name of a client and the color work only of the works that the user can see
				$work_view->client_name = $this->getClientName($work_view->client_owner);
				$work_view->color = $this->calculateColor($work_view);
			}
		}

		foreach($edit_states as $edit_state) {//get the list of states that the user can edit
			$state=DB::table('states') 
			->where('id', '=', $edit_state->states_id)
			->first();
			array_push($editStates, $state);
		}

		$works = $works_view;

		
		//$work_states = $editStates;

		//return $editStates;

		$user_type = Auth::user()->user_type_id;
		if($user_type == 1) {//admin user
			return view('admin.works.index', compact('works', 'work_states'));//if in some case the admin use this method
		} else if($user_type == 2) {//reception user
			return view('reception.works.index', compact('works', 'work_states', 'editStates'));
		}
	}

	/**
	 * This method is for index works in boss designer, returns the view of works in boss designer
	 * 
	 */
	private function indexBossDesigner($works) {
		$work_states = new State();
		$work_states = $work_states->where('active_flag', '1')->get();
		$designer = new User();
		$designer = $designer->where('active_flag', '1')
		->where('user_type_id', '4')
		->orWhere('user_type_id', '3')
		->get();

		
		foreach($works as $work){//get the name and de lastname of the physical clients.
			$owner = Client::where('id', $work->client_owner)->first();
			if($owner->type == 1) {
				$physical_client = Physical_client::where('client_id', $owner->id)->first();
				$work->client_name = $owner->name . " " . $physical_client->lastname;
			} else {
				$work->client_name = $owner->name;
			}
		}

		$color = "default";
		foreach($works as $work) {//
			$state_works=DB::table('state_work')
			->where('work_id', '=', $work->work_id)
			->orderby('date','DESC')->first();

			$states=DB::table('states')
			->where('id', '=', $state_works->states_id)
			->first();

			$work->work_state = $states->id;

			$work->color = $this->calculateColor($work);
		}
		//return $designer;
		//return $works;
		return view('designer/boss_designer/works/index', compact('works', 'work_states', 'designer'));
	}


	/**
	 * Get the name of a client by id
	 * 
	 */
	private function getClientName($client_id)
	{
		$owner = Client::where('id', $client_id)->first();
		$name;	
		if($owner->type == 1) {
			$physical_client = Physical_client::where('client_id', $client_id)->first();
			$name = $owner->name . " " . $physical_client->lastname;
		} else {
			$name = $owner->name;
		}
		return $name;
	}


	/**
	 * According to the delivery time, assign a color for the delivery of the work.
	 *
	 * 
	 */
	private function calculateColor($work)
	{
		
		$entry_date=Carbon::parse($entry_date=Carbon::parse($work->entry_date)->format('Y-m-d'));//text to date and format
		$delivery_date=Carbon::parse($delivery_date=Carbon::parse($work->approximate_date)->format('Y-m-d'));//text to date and format
			
		$date_diff=$entry_date->diffInDays($delivery_date);//calculate the difference of days beetwen entry date and delivery date
		$work->days = $date_diff;//Borrar

		$actual_date = Carbon::now(new \DateTimeZone('America/Costa_Rica'))->format('Y-m-d');
		//$actual_date = "2019-06-24";
		$actual_date=Carbon::parse($actual_date);//text to date

		$time_left=$actual_date->diffInDays($delivery_date);//calculate the available time

		if($delivery_date <= $actual_date) {//calculate the delay time
			$time_left=$actual_date->diffInDays($delivery_date);
			$time_left = $time_left * -1;
		}

		$work->time_left = $time_left;//Importante meter en la gráfica, lleva el tiempo restante y el de atraso

		$color = "default";
		if($date_diff <= 2){//less than 2 days
			$color = "red";
		} else if($date_diff <= 3) {//3 days
			if($time_left <= 2) {
				$color = "red";
			} else { $color = "yelow";}	
		} else if($date_diff <= 4) {//4 days
			if($time_left <= 2) {
				$color = "red";
			} else if($time_left <= 4) {
				$color = "yelow";
			} 
		} else if($date_diff % 2 == 0) {//even numbers
			$days_green = ($date_diff / 2) - 1;
			$days_yellow = $days_green;
			$days_red = 2;
			if($time_left <= 2) {
				$color="red";
			} else if($time_left <= $days_yellow + $days_red) {//considerar si hay que poner <=
				$color="yellow";
			} else { $color = "green"; }
		} else {//odd numbers
			$days_green = ($date_diff - 1) / 2;
			$days_yellow = $days_green - 1;
			$days_red = 2;
			if($time_left <= 2) {
				$color="red";
			} else if($time_left <= $days_yellow + $days_red) {//considerar si hay que poner solo <
				$color="yellow";
			} else { $color = "green"; }
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
		return view('works.create');
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

		return redirect()->route('works.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$work = Work::where('id', $id)->first();
		$product = Product::where('id', $id)->first();

		$work->product_name = $product->name;

		/*if($work->print_date == null) {
			$work->print_date = "No ha ingresado a impresión";
		}
		if($work->designer_date == null) {
			$work->designer_date = "No ha ingresado a diseño";
		}
		if($work->post_production_date == null) {
			$work->post_production_date = "No ha ingresado a post-producción";
		}
		if($work->drying_hours == null) {
			$work->drying_hours = "No se ha asignado las horas de secado";
		}*/

		/*$materials = Material_work::where('work_id', $id)->get();
		//$work = $this->model->find($id);

		if($materials->isEmpty()) {
			$work->materials = "No posee materiales";
		} else {
			$work->materials = $materials;
		}*/
		return json_encode(["work"=>$work]);
		//return $work;
		//return view('works.show', compact('work'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$work = $this->model->findOrFail($id);
		
		return view('works.edit', compact('work'));
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

		$work = $this->model->findOrFail($id);		
		$work->update($inputs);

		return redirect()->route('works.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('works.index')->with('message', 'Item deleted successfully.');
	}

	function changeWorkState($workID, $stateID) {

		DB::beginTransaction();

		$userID = Auth::user()->id;
		
/*
		$order_state_model = new Order_order_state();
		$order_state_model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
		$order_state_model->order_states_id = $stateID;//The state that the user choosed
		$order_state_model->order_id = $orderID;
		$order_state_model->user_id = $userID;
		$order_state_model->save();

		$orderWorks = \App\Work::where('order_id', $orderID)->get();

		foreach ($orderWorks as $work) {*/
			$state_work_Model = new State_work();
			$state_work_Model->date = Carbon::now(new \DateTimeZone('America/Costa_Rica'));
			$state_work_Model->states_id = $stateID;//Inicio work state
			$state_work_Model->work_id = $workID;
			$state_work_Model->user_id = $userID;
			$state_work_Model->save();
	/*}*/

		DB::commit();
		return json_encode(["message" => "¡Estado de la Orden y los Trabajos actualizados satisfactoriamente!"]); 
	}

	public function products_chart(Request $request) 
	{
		
		$from = Carbon::createFromFormat('d/m/Y', $request->startDate); 
		$to = Carbon::createFromFormat('d/m/Y', $request->endDate); 

		$products = DB::table('products')->where('active_flag', '=', 1)
		->select('products.name', 'products.id')
		->get();
		
		foreach ($products as $product) {
			$works = DB::table('works')->where('active_flag', '=', 1)
			->where('product_id', '=', $product->id)
			->whereBetween('entry_date', [$from, $to])->get();
			$product->total = $works->count();
			$product->start = $from;
			$product->end = $to;
		}

		$products = collect($products)->sortBy('total')->reverse();
		$products = collect($products)->take(3);
		return view('admin/reports/mostProductSell',['products'=>$products]);
	}

	public function changeDesignerWork($work_id, $designer_id){
		DB::beginTransaction();

			$userID = Auth::user()->id;
			
			$work = $this->model->find($work_id);
			if ($work !=null) {
				$work->designer_id = $designer_id;
				$work->save();
			}
	
			DB::commit();
			return json_encode(["message" => "¡Estado de la Orden y los Trabajos actualizados satisfactoriamente!"]); 
		return view('admin/reports/mostProductSell',['products'=>$products]);
	}

	public function materials_chart(Request $request) 
	{
		$from = Carbon::createFromFormat('d/m/Y', $request->startDate); 
		$to = Carbon::createFromFormat('d/m/Y', $request->endDate); 
		
		$works = DB::table('works')->where('active_flag', '=', 1)//get the works between two dates 
		->whereBetween('entry_date', [$from, $to])
		->select('works.id', 'works.entry_date', 'works.approximate_date')->get();
		
		$material_works = [];
		$materials;

		foreach ($works as $work) { //get the list of materials used in the works
			$material_work = DB::table('material_works')
			->where('work_id','=', $work->id)
			->get();
			foreach ($material_work as $material) { 
				if (!empty($material) && ($material != null) && ($material != "")){
					$material->start = $from;
					$material->end = $to;
					array_push($material_works, $material);
				}
			}	
		}
		
		foreach ($material_works as $material_work) { //get the name of the material used in the work
			$material = DB::table('materials')
			->where('id','=', $material_work->material_id)
			->first();
			$material_work->name = $material->name;	
		}
		
		foreach ($material_works as $material_work) { //get the count of an specific material used in the works
			$material_count = DB::table('material_works')
			->where('material_id','=', $material_work->material_id)
			->get();
			$material_work->total = $material_count->count();
		}

		$material_withOut= [];
		$count = 0;
		foreach ($material_works as $material_work) { //delete duplicates
			foreach($material_withOut as $material_ok){
				if($material_ok->material_id == $material_work->material_id) {
					$count = 1;
				}
			}
			if($count != 1){
				array_push($material_withOut, $material_work);
			}
			$count = 0;
		}

		$materials = $material_withOut;
		$materials = collect($materials)->sortBy('total')->reverse();
		$materials = collect($materials)->take(3);
		//return $materials;
		return view('admin/reports/mostMaterialSell',['materials'=>$materials]);
	}

}
