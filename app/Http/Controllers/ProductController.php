<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Branch;



class ProductController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var product
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Product $model)
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
		try {
			//custom message if this methods throw an exception
			\Session::put('errorOrigin', " mostrando los productos");
			//throw new \App\Exceptions\CustomException('Aquí ponen el nombre descriptivo de su error');
			//Gets all the list of products
			$products = $this->model->paginate();

			$products = DB::table('branches')->join(
				'products',
				'branches.id',
				'=',
				'products.branch_id'
			)->select(
				'products.id as id',
				'products.name as name',
				'products.description as description',
				'products.active_flag as active_flag',
				'branches.name as branch_idd',
				'branches.id as branch_id'
			)->get();

			return view('products.index', compact('products'));
			//return view('products.index', compact('branch'));
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			return redirect('home')->with('error', '¡Error en la base de datos
			al mostrar los productos!');
		} catch (\Exception $e) {
			report($e);
			return redirect('home')->with('error', '¡Error al mostrar los productos!');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * 
	 * @return Response
	 */
	public function create()
	{
		try {

			//custom message if this methods throw an exception
			\Session::put('errorOrigin', " accediendo a la creación de producto");

			return view('products.create');
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			return redirect('productIndex')->with('error', '¡Error en la base de datos
			 en la creación de productos!');
		} catch (\Exception $e) {
			report($e);
			return redirect('productIndex')->with('error', '¡Error en la creación de productos!');
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
		try {

			\Session::put('errorOrigin', " agregando el producto!");
			//  $branches=DB::table('branches')->where('name', '=', $request->branch_id)->get();
			DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction

			$inputs = $request->all();
			$this->model->create($inputs + ['active_flag'   => 1]);
			DB::commit(); //commits to database 

			return redirect()->route('products')->with('message', 'Producto creado satisfactoriamente!.');
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			DB::rollback();
			return redirect('products')->with('error', '¡Error en la base de datos
			agregando el producto!');
		} catch (\Exception $e) {
			report($e);
			DB::rollback();
			return redirect('products')->with('error', '¡Error agregando el producto!');
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
		try {
			//custom message if this methods throw an exception
			\Session::put('errorOrigin', " mostrando los productos");
			//throw new \App\Exceptions\CustomException('Aquí ponen el nombre descriptivo de su error');
			//Gets all the list of products
			$nameBranch =
				DB::table('products')->join('branches', 'branch_i  d ', '=', 'products.branch_id')
				->select('branches.name');

			$product = $this->model->find($id);

			return view('products.show', compact('product'));
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			return redirect('products')->with('error', '¡Error en la base de datos
		al mostrar los productos!');
		} catch (\Exception $e) {
			report($e);
			return redirect('products')->with('error', '¡Error al mostrar los productos!');
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
		try {
			//try y catch faltan
			\Session::put('errorOrigin', " editando el producto");
			$product = $this->model->find($id);

			return view('products.edit', compact('product'));
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			return redirect('products')->with('error', '¡Error en la base de datos
			al editar el producto!');
		} catch (\Exception $e) {
			report($e);
			return redirect('products')->with('error', '¡Error al editar el producto!');
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
		try {

			\Session::put('errorOrigin', " actualizando el producto!");

			$inputs = $request->all();
			DB::beginTransaction(); //starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.

			$product = $this->model->find($id);
			$product->update($inputs);

			DB::commit(); //commits to database 
			return redirect()->route('products')->with('message', 'Producto actualizado satisfactoriamente!.');
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			DB::rollback();
			return redirect('products')->with('error', '¡Error en la base de datos
		actualizando el producto!');
		} catch (\Exception $e) {
			report($e);
			DB::rollback();
			return redirect('products')->with('error', '¡Error actualizando el producto!');
		}
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
		try {

			\Session::put('errorOrigin', " eliminando el producto");
			$client = $this->model->find($id);
			$this->model->destroy($id);

			return redirect()->route('products.index')->with('message', 'Producto eliminado satisfactoriamente.');
		} catch (\Illuminate\Database\QueryException $e) {
			report($e);
			return redirect('productIndex')->with('error', '¡Error en la base de datos
		al eliminar el producto!');
		} catch (\Exception $e) {
			report($e);
			return redirect('productIndex')->with('error', '¡Error al eliminar el producto!');
		}
	}*/

	public function destroy($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " desactivando el producto");
		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "products");
		DB::beginTransaction(); //starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		$product = $this->model->find($id);

		if ($product == null) {
			throw new \Exception('Error en desactivar el producto con el id:' . $id
				. " en el método ProductController@destroy");
		} else {
			$product->active_flag = 0;
			$product->save();
			DB::commit(); //commit to database
			$user_type = Auth::user()->user_type_id;
			if ($user_type == 1) { //admin user
				return redirect('products')->with(
					'success',
					'¡Producto desactivado satisfactoriamente!'
				);
			}
		}
	}

	public function activate($id)
	{

		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " activando el producto");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "products");

		DB::beginTransaction(); //starts database transaction. If there´s no commit no transaction
		//will be made. Also, all transactions can be rollbacked.
		$product = $this->model->find($id);

		if ($product == null) {
			throw new \Exception('Error al activar el producto con el id:' . $id
				. " en el método ProductController@activate");
		} else {

			$product->active_flag = 1;
			$product->save();

			DB::commit(); //commit to database

			$user_type = Auth::user()->user_type_id;
			if ($user_type == 1) { //admin user
				return redirect('products')->with(
					'success',
					'¡Producto activado satisfactoriamente!'
				);
			}
		}
	}

	public function active_products_branch()
	{
			//custom message if this methods throw an exception
			\Session::put('errorOrigin', " cargando los productos de la sucursal");
			
			//custom route to REDIRECT redirect('x') if there's an error
			\Session::put('errorRoute', "orders");

			$products = $this->model->where('branch_id', '=', Auth::user()->branch_id)
			->where('active_flag', 1)->orderBy('id', 'asc')->get();

			return json_encode(["products"=>$products]);
	}

}
