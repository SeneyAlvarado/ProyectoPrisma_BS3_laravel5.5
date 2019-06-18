<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('branches.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$brach = new Branch();
		$brach->active_flag = 1;
		$brach->name = $request->name;
		$brach->save();
		
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal creada satisfactoriamente!');;
			
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$branch = $this->model->findOrFail($id);

		return view('branches.show', compact('branch'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$branch = $this->model->findOrFail($id);

		return view('branches.edit', compact('branch'));
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
		try {
			\Session::put('errorOrigin', " agregando la sucursal");
			
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

			}catch(\Illuminate\Database\QueryException $e){
				report($e);
				DB::rollback();
				return redirect('branch')->with('error', '¡Error en la base de datos
				agregando la sucursal!');
			}
			catch(\Exception $e){
				report($e);
				DB::rollback();
				return redirect('branch')->with('error', '¡Error agregando la sucursal!');
			}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$branch = $this->model->findOrFail($id);
		$branch->active_flag = 0;
		$branch->save();
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal desactivada satisfactoriamente!');;
		}

	}

	
	public function activate($id)
	{
		$branch = $this->model->findOrFail($id);
		$branch->active_flag = 1;
		$branch->save();
		
		$user_type = Auth::user()->user_type_id;		
		if($user_type == 1){//admin user
			return redirect()->route('branch')->with('success', '¡Sucursal activada satisfactoriamente!');;
			
		}
	}
}
