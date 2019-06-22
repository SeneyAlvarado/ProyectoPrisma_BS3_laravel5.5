<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class VisitController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var visit
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Visit $model)
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
		$visits = $this->model->paginate();

		return view('admin/visits/index', compact('visits'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/visits/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$visit = new Visit();
		$visit->client_name = $request->client_name;
		$visit->date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
		$visit->phone = $request->phone;
		$visit->email = $request->email;
		$visit->recepcionist_id = null;
		$visit->details = $request->details;
		$visit->active_flag = 1;
		$visit->visitor_id = Auth::user()->id;
		//return $visit;
		$visit->save();

		return redirect('visits')->with('success', 'El elemento fue creado correctamente');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$visit = $this->model->find($id);
		
		return view('admin/visits/show', compact('visit'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$visit = $this->model->find($id);
		
		return view('admin/visits/edit', compact('visit'));
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

		$visit = $this->model->find($id);		
		$visit->update($inputs);
		

		return redirect('visits')->with('success', 'Los cambios se guardaron exitosamente');
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

		return redirect('visits')->with('success', 'La información de la visita se eliminó correctamente.');
	}
}