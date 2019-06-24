<?php

namespace App\Http\Controllers;

use App\Coin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var coin
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Coin $model)
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
		$coins = $this->model->paginate();

		return view('coins.index', compact('coins'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('coins.create');
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

		return redirect()->route('coins.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$coin = $this->model->findOrFail($id);
		
		return view('coins.show', compact('coin'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$coin = $this->model->findOrFail($id);
		
		return view('coins.edit', compact('coin'));
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

		$coin = $this->model->findOrFail($id);		
		$coin->update($inputs);

		return redirect()->route('coins.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('coins.index')->with('message', 'Item deleted successfully.');
	}



	public function dolarExchangeRate()
	{
		$doc_c = new \DOMDocument();
		$doc_v = new \DOMDocument();
		$ind_econom_ws =  'http://indicadoreseconomicos.bccr.fi.cr/indicadoreseconomicos/WebServices/wsIndicadoresEconomicos.asmx/ObtenerIndicadoresEconomicos';
		$fecha = date("d/m/Y");
		$compra = 317;
		$venta = 318;

		$urlWS_c = $ind_econom_ws . "?tcIndicador=" . $compra . "&tcFechaInicio=" . $fecha . "&tcFechaFinal=" . $fecha . "&tcNombre=tq&tnSubNiveles=N";
		$urlWS_v = $ind_econom_ws . "?tcIndicador=" . $venta . "&tcFechaInicio=" . $fecha . "&tcFechaFinal=" . $fecha . "&tcNombre=tq&tnSubNiveles=N";

		//Valor Compra
		$xml_c = file_get_contents($urlWS_c);
		$doc_c->loadXML($xml_c);
		$ind_c = $doc_c->getElementsByTagName('INGC011_CAT_INDICADORECONOMIC')->item(0);
		$val_c = $ind_c->getElementsByTagName('NUM_VALOR')->item(0);
		$valor_compra = substr($val_c->nodeValue, 0, -6);

		//Valor Venta, comentado porque por ahora no lo usamos.
		/*$xml_v = file_get_contents($urlWS_v);
		$doc_v->loadXML($xml_v);
		$ind_v = $doc_v->getElementsByTagName('INGC011_CAT_INDICADORECONOMIC')->item(0);
		$val_v = $ind_v->getElementsByTagName('NUM_VALOR')->item(0);
		$valor_venta = substr($val_v->nodeValue, 0, -6);*/


		//$valor_compra = str_replace(".",",",$valor_compra);
		//Mostrar Valores
		return $valor_compra;
		//echo 'Valor compra: ' . $valor_compra;
		//echo '<br/>Valor venta: ' . $valor_venta;
	}
}