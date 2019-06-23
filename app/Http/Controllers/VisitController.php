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
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando las visitas");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");
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
		\Session::put('errorOrigin', " accediendo a la creación de visitas");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits");
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
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando la visita");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits.create");
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
		$visit = new Visit();
		$visit->client_name = $request->client_name;
		$visit->date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
		$visit->phone = $request->phone;
		$visit->email = $request->email;
		$visit->recepcionist_id = null;
		$visit->details = $request->details;
		$visit->active_flag = 1;
		$visit->visitor_id = Auth::user()->id;
		$visit->save();
		DB::commit();//commits to database 
		return redirect('visits')->with('success', '¡Visita registrada satisfactoriamente!');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		\Session::put('errorOrigin', " editando la visita");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits");
		$visit = $this->model->find($id);
		if($visit==null){
			throw new \Exception('Error en editar visita con el id:' .$id
				. " en el método VisitController@edit");
		} else {
			return view('admin/visits/edit', compact('visit'));
		}
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
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " actualizando la visita");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits");
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
		$inputs = $request->all();
		$visit = $this->model->find($id);	
		if ($visit==null) {
			throw new \Exception('Error en actualizar visita con el id:' .$id
				. " en el método VisitController@update");
		} else {
			$visit->update($inputs);
			DB::commit();//commits to database 
			return redirect('visits')->with('success', '¡Visita actualizada satisfactoriamente!');
		}
	}

	/**
	 * Remove the specified visit from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " eliminando la visita");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits");
		$visit = $this->model->find($id);
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
		if($visit==null){
			throw new \Exception('Error en eliminar visita con el id:' .$id
				. " en el método VisitController@destroy");
		}else{
			$visit->active_flag = 0;
			$visit->save();
			DB::commit();//commits to database 
		return redirect('visits')->with('success', '¡Visita eliminada correctamente!');
		}
	}
}