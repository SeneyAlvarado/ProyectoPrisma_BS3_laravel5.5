<?php

namespace App\Http\Controllers;

use App\Material_work;
use App\Product;
use App\Work;
use App\State;
use App\State_work;
use App\Client;
use App\Physical_client;
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

		/*work states*/
		$work_states = new State();
		$work_states = $work_states->where('active_flag', '1')->get();

		$works = DB::table('works')
		->join('orders', 'works.order_id', 'orders.id')
		->select('works.id as work_id',
		'works.priority as priority',
		//'works.advance_payment as advance_payment',
		'works.approximate_date as approximate_date',
		//'works.designer_date as designer_date',
		//'works.print_date as print_date',
		//'works.post_production_date as post_production_date',
		//'works.observation as observation',
		//'works.drying_hours as drying_hours',
		'works.entry_date as entry_date',
		'works.active_flag as active_flag',
		'orders.client_owner as client_owner')
		->orderBy('priority', 'DESC')->orderBy('approximate_date', 'ASC')
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

		/*$clients=DB::table('clients')//get all juridical and physical clients of the BD,
		->where('active_flag', '=', 1)
		->get();

		$name;
		foreach($clients as $client){ //get the full name of the physical clients
			if($client->type == 1){
				$phisClient = Physical_client::where('client_id', $client->id)->first();
				$name = $client->name . " " . $phisClient->lastname;		
			} else {
				$name = $client->name;
			}
		}*/

		$color = "default";
		foreach($works as $work) {//
			//$work->client_name = $name;
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
				return view('designer/works/index', compact('works', 'work_states'));
			}
		
		//return view('works/index', compact('works'));
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

		$from=Carbon::parse($request->startDate)->format('Y-m-d');
		//$from="2019-06-01";
		//$to=Carbon::parse($request->endDate)->format('Y-m-d');
		$to = "2019-06-30";
		$products = DB::table('products')->where('active_flag', '=', 1)
		->select('products.name', 'products.id')
		->get();
		
		foreach ($products as $product) {
			$works = DB::table('works')->where('active_flag', '=', 1)
			->where('product_id', '=', $product->id)
			->whereBetween('entry_date', [$from, $to])->get();
			$product->total = $works->count();
			$product->start = $request->startDate;
			$product->end = $request->endDate;
		}

		$products = collect($products)->sortBy('total')->reverse();
		$products = collect($products)->take(3);

		/*$content='';
		
        $content.= '<html>
		<head>
		<link rel="stylesheet" href="bootstrap.min.css">
		  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		  <script type="text/javascript">
		  try { this.print(); } catch (e) { window.onload = window.print; } 
			google.charts.load(\'current\', {\'packages\':[\'corechart\']});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
				[\'Productos\', \'mes\'],';
				  foreach ($products as $product){
					$content .= '['.$product->name.', '. $product->total .'],';
				  }
				  
			  $content.=']);
	  
			  var options = {
				title: \'Producto más vendido\'
			  };
			  var chart = new google.visualization.PieChart(document.getElementById(\'piechart\'));
	  
			  chart.draw(data, options);
			}
		  </script>
		</head>
		<body>
		<h4>Reporte de los porductos más vendidos del día '.$product->start. ' al '.$product->end.'</h4>
		  <div id="piechart" style="width: 900px; height: 500px;"></div>
		</body>
	  </html>';
         $html2pdf = new Html2Pdf('P', 'Legal', 'es', true, 'UTF-8');
			$html2pdf->pdf->SetTitle('HTML2PDF Sample');
			$html2pdf->pdf->IncludeJS('print(TRUE)');
            $html2pdf->WriteHTML($content);
           return $html2pdf->Output('example.pdf'); */


/*
		//require dirname(__FILE__).'\..\vendor\autoload.php';
		require app_path()."/config.php";
		ob_start();
		require "/resources/views/admin/reports/mostProductSell.blade.php";
		$html = ob_get_clean();
		
		
		$html2pdf = new HTML2PDF('P', 'A4', 'es', 'true', 'UTF-8');
		$html2pdf->writeHTML($html);
		//$html2pdf->pdf->IncludeJS('print(TRUE)');
		return $html2pdf->output('pdf_generated.pdf');*/
		/*$pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('admin/reports/mostProductSell', compact('products'))->render()); 
        return $pdf->stream('ProductosMasVendidos'.$product->end.'.pdf');*/
		//return $products;
		return view('admin/reports/mostProductSell',['products'=>$products]);
	}

}