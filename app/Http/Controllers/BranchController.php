<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

/**
 * 
 * This class is responsible for the management of branches.
 * 
 */
class BranchController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var branch
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Branch $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the branches in the sistem.
	 *
	 * @return Response
	 */
	public function index()
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando las sucursales");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");

		$branches = DB::table('branches')->get();
		
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.branches.index', compact('branches'));
		}
	}

	/**
	 * This method return the list of all branches
	 * that must be show in combo box.
	 * 
	 */
	public function list()
	{
		$branches = $this->model->paginate();
		return view('products.create', compact('branches'));
	}
	public function list2()
	{
		$branches = $this->model->paginate();
		return view('products.edit', compact('branches'));
	}

	public function listMaterial()
	{
		$branches = $this->model->paginate();
		return view('materials.create', compact('branches'));
	}
	public function list2Material()
	{
		$branches = $this->model->paginate();
		return view('materials.edit', compact('branches'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando la sucursal");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "branch");

		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.

		$brach = new Branch();
		$brach->active_flag = 1;
		$brach->name = $request->name;
		$brach->save();
		
		DB::commit();//commits to database 

		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal creada satisfactoriamente!');;
			
		}
	}

	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " actualizando la sucursal");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "branch");
			
		if (strlen(trim($request->name)) == 0){
			return back()->with('error', 'El nombre de la sucursal es requerido');
		}
			
		DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.

		$id = $request->id;
		$branch = $this->model->findOrFail($id);
		$branch->name = $request->name;
		$branch->update();

		$user_type = Auth::user()->user_type_id;	

		DB::commit();//commits to database 
		
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal actualizada satisfactoriamente!');;	
		}

	}

	/**
	 * Desactivate an specific branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " desactivando la sucursal");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "branch");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.

		$branch = $this->model->find($id);
		$branch->active_flag = 0;
		$branch->save();

		DB::commit();//commit to database
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal desactivada satisfactoriamente!');;
		}

	}

	/**
	 * Activate an specific branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function activate($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " activando la cuenta");	

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "branch");

		DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.

		$branch = $this->model->find($id);
		$branch->active_flag = 1;
		$branch->save();

		DB::commit();//commit to database
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal activada satisfactoriamente!');;
			
		}
	}
}
