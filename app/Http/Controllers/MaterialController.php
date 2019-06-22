<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class MaterialController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var material
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Material $model)
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
		$materials = $this->model->paginate();

		$materials = DB::table('branches')->join(
			'materials',
			'branches.id',
			'=',
			'materials.branch_id'
		)->select(
			'materials.id as id',
			'materials.name as name',
			'materials.description as description',
			'materials.active_flag as active_flag',
			'branches.name as branch_idd',
			'branches.id as branch_id'
		)->get();

		return view('materials.index', compact('materials'));
		//return $materials;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('materials.create');
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
		$this->model->create($inputs + ['active_flag' => 1]);

		return redirect()->route('materials')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$material = $this->model->findOrFail($id);

		return view('materials.show', compact('material'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$material = $this->model->findOrFail($id);

		return view('materials.edit', compact('material'));
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

		$material = $this->model->findOrFail($id);
		$material->update($inputs);

		return redirect()->route('materials.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function destroy($id)
	{
		$this->model->destroy($id);

		return redirect()->route('materials.index')->with('message', 'Item deleted successfully.');
	}*/
	public function destroy($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " desactivando el material");
		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "materials");
		DB::beginTransaction(); //starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		$material = $this->model->find($id);

		if ($material == null) {
			throw new \Exception('Error en desactivar el material con el id:' . $id
				. " en el método MaterialController@destroy");
		} else {
			$material->active_flag = 0;
			$material->save();
			DB::commit(); //commit to database
			$user_type = Auth::user()->user_type_id;
			if ($user_type == 1) { //admin user
				return redirect('materials')->with(
					'success',
					'¡Material desactivado satisfactoriamente!'
				);
			}
		}
	}

	public function activate($id)
	{

		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " activando el material");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "material");

		DB::beginTransaction(); //starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		$material = $this->model->find($id);

		if ($material == null) {
			throw new \Exception('Error al activar el material con el id:' . $id
				. " en el método MaterialController@activate");
		} else {

			$material->active_flag = 1;
			$material->save();

			DB::commit(); //commit to database

			$user_type = Auth::user()->user_type_id;
			if ($user_type == 1) { //admin user
				return redirect('materials')->with(
					'success',
					'¡Material activado satisfactoriamente!'
				);
			}
		}
	}
}
