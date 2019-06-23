<?php

namespace App\Http\Controllers;

use App\Work;
use App\Physical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$works = DB::table('works')
		->join('orders', 'works.order_id', 'orders.id')
		->select('works.id as work_id',
		'works.priority as priority',
		'works.advance_payment as advance_payment',
		'works.approximate_date as approximate_date',
		'works.designer_date as designer_date',
		'works.print_date as print_date',
		'works.post_production_date as post_production_date',
		'works.observation as observation',
		'works.drying_hours as drying_hours',
		'orders.entry_date as entry_date',
		'orders.client_owner as client_owner')
		->get();

		$clients=DB::table('clients')
		->where('active_flag', '=', 1)
		->get();

		$name;//name of the client
		foreach($clients as $client){
			if($client->type == 1){
				$phisClient = Physical_client::where('client_id', $client->id)->first();
				$name = $client->name . " " . $phisClient->lastname . " " .  $phisClient->second_lastname;		
			} else {
				$name = $client->name;
			}
		}

		foreach($works as $work){
			$work->client_name = $name;
			$entry_date=Carbon::parse($work->entry_date);
			$delivery_date=Carbon::parse($work->approximate_date);
			$date_diff=$entry_date->diffInDays($delivery_date);
			$work->days = $date_diff;
			
			$state_work=DB::table('state_work')
			->where('active_flag', '=', 1)
			->where('work_id', '=', $work->work_id)
			->get();
			$work->state_id = $state_work->id;
		}

		

		//$works = $this->model->paginate();
		return $works;
		return view('works/index', compact('works'));
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
		$work = $this->model->findOrFail($id);
		
		return view('works.show', compact('work'));
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
}