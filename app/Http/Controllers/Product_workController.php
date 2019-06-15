<?php

namespace App\Http\Controllers;

use App\Product_work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Product_workController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var product_work
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Product_work $model)
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
		$product_works = $this->model->paginate();

		return view('product_works.index', compact('product_works'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('product_works.create');
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

		return redirect()->route('product_works.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 * 
	 */
	public function show($id)
	{
		$product_work = $this->model->findOrFail($id);
		
		return view('product_works.show', compact('product_work'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product_work = $this->model->findOrFail($id);
		
		return view('product_works.edit', compact('product_work'));
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

		$product_work = $this->model->findOrFail($id);		
		$product_work->update($inputs);

		return redirect()->route('product_works.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('product_works.index')->with('message', 'Item deleted successfully.');
	}
}