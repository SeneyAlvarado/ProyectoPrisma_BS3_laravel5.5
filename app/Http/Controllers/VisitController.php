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
	 * Display a listing of the visits.
	 *
	 * @return Response
	 */
	public function index()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando las visitas");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");
		

		$user_type = Auth::user()->user_type_id;

		if($user_type == 1){//admin user
			$visits = DB::table("visits")
			->where('branch_id', '=', Auth::user()->branch_id)
			->orderby('active_flag', 'DESC')->orderby('id', 'DESC')->get();

			foreach($visits as $visit ) {//search the name of the visitor
				$visitor = DB::table("users")->where("id", $visit->visitor_id)->first();
				$visit->visitor = $visitor->name . " " . $visitor->lastname;
				if($visit->email == null) {
					$visit->email = "No posee";
				}
				if(($visit->phone == null) || ($visit->phone == "")) {
					$visit->phone = "No posee";
				}
			} 
		
			//return $visits;
			return view('admin/visits/index', compact('visits'));
		
		} else if($user_type == 2){//reception user
			$visits = DB::table("visits")->where("active_flag", '<>', 0)
			->orderby('active_flag', 'ASC')->orderby('id', 'DESC')->get();
			foreach($visits as $visit ) {//search the name of the visitor
				$visitor = DB::table("users")->where("id", $visit->visitor_id)->first();
				$visit->visitor = $visitor->name . " " . $visitor->lastname;

				if($visit->email == null) {
					$visit->email = "No posee";
				}
				if($visit->phone == null) {
					$visit->phone = "No posee";
				}
			}	
			return view('reception/visits/index', compact('visits'));
		} else if($user_type == 3 || $user_type == 4 || $user_type == 5 || $user_type == 6 || $user_type == 7) {
			$visits = DB::table("visits")->where("active_flag", '<>', 0)
			->orderby('active_flag', 'ASC')->orderby('id', 'DESC')->get();
			foreach($visits as $visit ) {//search the name of the visitor
				$visitor = DB::table("users")->where("id", $visit->visitor_id)->first();
				$visit->visitor = $visitor->name . " " . $visitor->lastname;
				if($visit->email == null) {
					$visit->email = "No posee";
				}
				if($visit->phone == null) {
					$visit->phone = "No posee";
				}
			}	
			if($user_type == 3 || $user_type == 4) {
				return view('designer/visits/index', compact('visits'));
			} else if($user_type == 5) {
				return view('print/boss_print/visits/index', compact('visits'));
			} else if($user_type == 6) {
				return view('print/regular_print/visits/index', compact('visits'));
			} else if($user_type == 7) {//post production user
				return view('postProduction/visits/index', compact('visits'));
			}
		} 

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
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1) { //admin user
			return view('admin/visits/create');
		} else if($user_type == 2){//reception user
		} else if ($user_type == 3) { //boss designer user
			return view('designer/visits/create');
		}else if ($user_type == 4) { //boss designer user
			return view('designer/visits/create');
		}else if ($user_type == 5) { //boss print user
			return view('print/boss_print/visits/create');
		}else if ($user_type == 6) { //regular print user
			return view('print/regular_print/visits/create');
		} else if ($user_type == 7) { //post production user
			return view('postProduction/visits/create');
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
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando la visita");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits.create");
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.

		if($request->email == null and $request->phone== null){
			return back()->with('error','Debe brindar un número de teléfono o un correo electrónico')->withInput();
		} else {
			$visit = new Visit();
			$visit->client_name = $request->client_name;
			$visit->date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
			$visit->phone = $request->phone;
			$visit->email = $request->email;
			$visit->recepcionist_id = null;
			$visit->details = $request->details;
			$visit->active_flag = 1;
			$visit->branch_id = Auth::user()->branch_id;
			$visit->visitor_id = Auth::user()->id;
			$visit->save();
			DB::commit();//commits to database 
			return redirect('visits')->with('success', '¡Visita registrada satisfactoriamente!');
		}
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
		$user_type = Auth::user()->user_type_id;
		if($visit==null){
			throw new \Exception('Error en editar visita con el id:' .$id
				. " en el método VisitController@edit");
		} else if ($user_type == 1) {//admin
			return view('admin/visits/edit', compact('visit'));
		} else if($user_type == 2){//reception user
		} else if ($user_type == 3) { //boss designer user
			return view('designer/visits/edit', compact('visit'));
		} else if ($user_type == 4) { //boss designer user
			return view('designer/visits/edit', compact('visit'));
		} else if ($user_type == 5) { //boss designer user
			return view('print/boss_print/visits/edit', compact('visit'));
		} else if ($user_type == 6) { //boss designer user
			return view('print/regular_print/visits/edit', compact('visit'));
		} else if ($user_type == 7) { //post production user
			return view('postProduction/visits/edit', compact('visit'));
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
			if($request->email == null and $request->phone== null){
				return back()->with('error','Debe brindar un número de teléfono o un correo electrónico')->withInput();
			} else {
				$visit->update($inputs);
				DB::commit();//commits to database 
				return redirect('visits')->with('success', '¡Visita actualizada satisfactoriamente!');
			}
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

	public function solve($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " resolviendo la visita");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "visits");
		$visit = $this->model->find($id);
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
		if($visit==null){
			throw new \Exception('Error en resolver visita con el id:' .$id
				. " en el método VisitController@solve");
		}else{
			$visit->active_flag = 3;
			$visit->recepcionist_id = Auth::user()->id;
			$visit->save();
			DB::commit();//commits to database 
			return redirect('visits')->with('success', '¡Visita resualta correctamente!');
		}
	}
}