<?php

namespace App\Http\Controllers;


use App\Client;
use App\Physical_client;
use App\Juridical_client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class ClientController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var client
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Client $model)
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
			\Session::put('errorOrigin', " mostrando los clientes");	

			//estas son pruebas de errores
		//throw new \App\Exceptions\CustomException('Aquí ponen el nombre descriptivo de su error');
		//DB::table('shdhgjd')->get();
		//Auth::attempt(['email' => $email, 'password' => $password]);


			
			
			//Gets all clients with their phone and emails
			$clients = $this->model::all();

			//return dd($clients[0]);
			for($x = 0; $x <= (count($clients)-1); $x++) {
				
				if($clients[$x]->type == 1) {//physical client, fill model attributes
					$phisClient = Physical_client::where('client_id', $clients[$x]->id)->first();
					$clients[$x]->lastname = $phisClient->lastname;
					$clients[$x]->second_lastname = $phisClient->second_lastname;	
					$clients[$x]->client_table_id = $phisClient->client_id;	
				}

				if($clients[$x]->type == 2) {//juridical client, fill model attributes
					$jurClient = Juridical_client::where('client_id', $clients[$x]->id)->first();
					$clients[$x]->client_table_id = $jurClient->client_id;	
				}
				$clients[$x]->phones = $clients[$x]->phones()->where('active_flag', 1)->get();
				$clients[$x]->emails = $clients[$x]->emails()->where('active_flag', 1)->get();
			}
			
			$user_type = Auth::user()->user_type_id;
			if($user_type == 1){//admin user
				return view('admin.clients.index', compact('clients'));
			}
		}catch(\App\Exceptions\CustomException $e){
			/*just some test code, not important
			$handler =  app(App\Exceptions\Handler::class);
			$handler->report($e);
			$handler->render($e);
			*/
			report($e);//this writes the error at the log
			\Session::flash('message_type', 'negative');
			\Session::flash('message_icon', 'hide');
			\Session::flash('message_header', 'Success');
            \Session::flash('error', '¡Ha ocurrido un error al mostrar los clientes!' 
            .' Si este persiste contacte al administrador del sistema');
			return redirect('admin');//aquí redirigen a la página deseada después de validar el error
			//NO USEN EL RETURN BACK, usen un return view o redirect o algo xD

		}

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.clients.create');
		}
		return view('clients.create');
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
			DB::beginTransaction();//starts databse transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
			

			$inputs = $request->except('lastname', 'second_lastname', 'number', 'email');
			$client_id = $this->model->create($inputs + ['active_flag' => 1])->id;

	 		$number = $request->number;
			if(!empty($number)) {
				$phone = new \App\Phone;
				$phone->number = $number;
				$phone->client_id = $client_id;
				$phone->active_flag = 1;
				$phone->save();
			};

			$user_email = $request->email;
			if(!empty($user_email)) {
				$email = new \App\Email;
				$email->email = $user_email;
				$email->client_id = $client_id;
				$email->active_flag = 1;
				$email->save();
			};

			$type = $request->type;
			if($request->type == "1"){
				$physical_client = new \App\Physical_client;
				$physical_client->lastname = $request->lastname;
				$physical_client->second_lastname = $request->second_lastname;
				$physical_client->client_id = $client_id;
				$physical_client->save();
			}

			if($request->type == "2"){
				$juridical_client = new \App\Juridical_client;
				$juridical_client->client_id = $client_id;
				$juridical_client->save();
			}

		DB::commit();//commits to database 

		return redirect('clients')->with('success', '¡Cliente registrado satisfactoriamente!');
		}catch(\Exception $e) {
			report($e);//this writes the error at the log
			DB::rollback();
            \Session::flash('error', '¡Ha ocurrido un error al insertar el cliente!' 
            .' Si este persiste contacte al administrador del sistema');
			return redirect('clients.create');//aquí redirigen a la página deseada después de validar el error
			//NO USEN EL RETURN BACK, usen un return view o redirect o algo xD
		}catch(\Throwable $e){//different exception that it´s not contained at \Exception
			report($e);//this writes the error at the log
			DB::rollback();
            \Session::flash('error', '¡Ha ocurrido un error al insertar el cliente!' 
            .' Si este persiste contacte al administrador del sistema.');
			return redirect('clients.create');//aquí redirigen a la página deseada después de validar el error
			//NO USEN EL RETURN BACK, usen un return view o redirect o algo xD
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
		$client = $this->model->findOrFail($id);
		
		return view('clients.show', compact('client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		//try y catch faltan
		\Session::put('errorOrigin', " mostrando los clientes");	

			$client = $this->model->findOrFail($id);
				
				if($client->type == 1) {//physical client, fill model attributes
					$phisClient = Physical_client::where('client_id', $client->id)->first();
					$client->lastname = $phisClient->lastname;
					$client->second_lastname = $phisClient->second_lastname;	
					$client->client_table_id = $phisClient->client_id;	
				}

				if($client->type == 2) {//juridical client, fill model attributes
					$jurClient = Juridical_client::where('client_id', $client->id)->first();
					$client->client_table_id = $jurClient->client_id;	
				}
				$client->phones = $client->phones()->where('active_flag', 1)->get();
				$client->emails = $client->emails()->where('active_flag', 1)->get();
			
		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.clients.edit', compact('client'));
		}
		return view('clients.edit', compact('client'));
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

		$client = $this->model->findOrFail($id);		
		$client->update($inputs);

		return redirect()->route('clients.index')->with('message', 'Item updated successfully.');
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

		return redirect()->route('clients.index')->with('message', 'Item deleted successfully.');
	}
}