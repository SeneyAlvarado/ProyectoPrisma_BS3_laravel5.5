<?php

namespace App\Http\Controllers;


use App\Client;
use App\Phone;
use App\Email;
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
		}catch(\Illuminate\Database\QueryException $e){
			report($e);
			return redirect('home')->with('error', '¡Error en la base de datos
			al mostrar los clientes!');
		}
		catch(\Exception $e){
			report($e);
			return redirect('home')->with('error', '¡Error al mostrar los cliente!');
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
			\Session::put('errorOrigin', " accediendo a la creación de clientes");	

			$user_type = Auth::user()->user_type_id;
			if($user_type == 1){//admin user
				return view('admin.clients.create');
			}
		}catch(\Illuminate\Database\QueryException $e){
			report($e);
			return redirect('clients')->with('error', '¡Error en la base de datos
			 en la creación de clientes!');
		}
		catch(\Exception $e){
			report($e);
			return redirect('clients')->with('error', '¡Error en la creación de clientes!');
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

			\Session::put('errorOrigin', " agregando el cliente");

			if (strlen(trim($request->name)) == 0){
				return back()->with('error', 'El campo Nombre es requerido');
			}
			if($request->type == "1"){//physical client
				if (strlen(trim($request->lastname)) == 0){
					return back()->with('error', 'El campo Primer Apellido es requerido');
				}
				if (strlen(trim($request->second_lastname)) == 0){
					return back()->with('error', 'El campo Segundo Apellido es requerido');
				}
			}

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

		}catch(\Illuminate\Database\QueryException $e){
			report($e);
			DB::rollback();
			return redirect('clients')->with('error', '¡Error en la base de datos
			agregando el cliente!');
		}
		catch(\Exception $e){
			report($e);
			DB::rollback();
			return redirect('clients')->with('error', '¡Error agregando el cliente!');
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
			\Session::put('errorOrigin', " editando el cliente");	

				$client = $this->model->find($id);

				if($client == null) {
					throw new \Exception('Error en editar el cliente con el id:' .$id
				. " en el método ClientController@edit");
				} else {
					
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
				//return $client;
				return view('admin.clients.edit', compact('client'));
			}
			
			}//end clients not null else
				
		}catch(\Illuminate\Database\QueryException $e){
			report($e);
			return redirect('clients')->with('error', '¡Error en la base de datos
			al editar el cliente!');
		}
		catch(\Exception $e){
			report($e);
			return redirect('clients')->with('error', '¡Error al editar el cliente!');
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

			\Session::put('errorOrigin', " actualizando el cliente");
			
			if (strlen(trim($request->name)) == 0){
				return back()->with('error', 'El campo Nombre es requerido');
			}
			if($request->type == "1"){//physical client
				if (strlen(trim($request->lastname)) == 0){
					return back()->with('error', 'El campo Primer Apellido es requerido');
				}
				if (strlen(trim($request->second_lastname)) == 0){
					return back()->with('error', 'El campo Segundo Apellido es requerido');
				}
			}

			DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
			
			$client = $this->model->find($id);

			if($client == null) {
				throw new \Exception('Error en actualizar el cliente con el id:' .$id
			. " en el método ClientController@update");
			} else {

			$client_id = $client->id;
			$number = $request->number;
			$inputEmail = $request->email;

			if(!empty($number)) {
				$phones = $client->phones()->get();//it´s a hasMany type, not a Model type, so it needs a get first
				$phoneExists = false;
				
				foreach ($phones as $phone) {
					if($phone->number == $number){
						$phone->active_flag = 1;
						$phone->save();
						$phoneExists = true;
					} else {
						$phone->active_flag = 0;
						$phone->save();
					}
				}

				if(!$phoneExists){//if the phone is not at the database
					$newPhone = new \App\Phone;
					$newPhone->number = $number;
					$newPhone->client_id = $client_id;
					$newPhone->active_flag = 1;
					$newPhone->save();
				}
			}//end if number not empty

			if(!empty($inputEmail)) {
				$emails = $client->emails()->get();//it´s a hasMany type, not a Model type, so it needs a get first
				$emailExists = false;
				
				foreach ($emails as $email) {
					if($email->email == $inputEmail){
						$email->active_flag = 1;
						$email->save();
						$emailExists = true;
					} else {
						$email->active_flag = 0;
						$email->save();
					}
				}

				if(!$emailExists){//if the email is not at the database
					$newEmail = new \App\Email;
					$newEmail->email = $inputEmail;
					$newEmail->client_id = $client_id;
					$newEmail->active_flag = 1;
					$newEmail->save();
				}
			}//end if email not empty

			$client->name = $request->name;
			$client->address = $request->address;
			$client->identification = $request->identification;
			$client->save();

			if($request->type == "1"){//physical client
				$physical_client = Physical_client::where('client_id', $client_id)->first();
				$physical_client->lastname = $request->lastname;
				$physical_client->second_lastname = $request->second_lastname;
				$physical_client->save();
			}

			DB::commit();//commits to database 
			return redirect('clients')->with('success', '¡Cliente actualizado satisfactoriamente!');

		}//end if client not null
		}catch(\Illuminate\Database\QueryException $e){
			report($e);
			DB::rollback();
			return redirect('clients')->with('error', '¡Error en la base de datos
			actualizando el cliente!');
		}
		catch(\Exception $e){
			report($e);
			DB::rollback();
			return redirect('clients')->with('error', '¡Error actualizando el cliente!');
		}
	}



/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function activate($id)
		{
			try {
			
				\Session::put('errorOrigin', " activando el cliente");

				DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
				$client = $this->model->find($id);
				
				if($client == null) {
					throw new \Exception('Error al activar el cliente con el id:' .$id
				. " en el método ClientController@activate");
				} else {
					
					$client->active_flag = 1;
					$client->save();

					DB::commit();//commit to database

					$user_type = Auth::user()->user_type_id;	
					if($user_type == 1){//admin user
						return redirect('clients')->with('success',
						'¡Cliente desactivado satisfactoriamente!');
					}
				}
			}catch(\Illuminate\Database\QueryException $e){
				report($e);
				DB::rollback();
				return redirect('clients')->with('error', '¡Error en la base de datos
				al activar el cliente!');
			}
			catch(\Exception $e){
				report($e);
				DB::rollback();
				return redirect('clients')->with('error', '¡Error al activar el cliente!');
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
			try {
			
				\Session::put('errorOrigin', " desactivando el cliente");

				DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
			//will be made. Also, all transactions can be rollbacked.
				$client = $this->model->find($id);
				
				if($client == null) {
					throw new \Exception('Error en desactivar el cliente con el id:' .$id
				. " en el método ClientController@destroy");
				} else {
					
					$client->active_flag = 0;
					$client->save();

					DB::commit();//commit to database

					$user_type = Auth::user()->user_type_id;	
					if($user_type == 1){//admin user
						return redirect('clients')->with('success',
						'¡Cliente desactivado satisfactoriamente!');
					}
				}
			}catch(\Illuminate\Database\QueryException $e){
				report($e);
				DB::rollback();
				return redirect('clients')->with('error', '¡Error en la base de datos
				al desactivar el cliente!');
			}
			catch(\Exception $e){
				report($e);
				DB::rollback();
				return redirect('clients')->with('error', '¡Error al desactivar el cliente!');
			}
	}


	public function show($id)
	{
		$client = $this->model->find($id);

				if($client == null) {
					throw new \Exception('Error en editar el cliente con el id:' .$id
				. " en el método ClientController@edit");
				} else {
					
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
				//return $client;
				return view('admin.orders.show_contact', compact('client'));
			}
			
			}
	}

	public function ajax_contact($id){//Prueba para cargar la info con ajax en un modal
		$client = $this->model->find($id);
				if($client == null) {
					throw new \Exception('Error en editar el cliente con el id:' .$id
				. " en el método ClientController@edit");
				} else {
					
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

					$phone = Phone::where('client_id', $client->id)->first();
					$email = Email::where('client_id', $client->id)->first();

					if($client->address == null){
						$client->address = "No posee";
					}

					if($client->identification == null){
						$client->identification = "No posee";
					}

					if($phone == null){
						$client->phone = "No posee";
					} else {
						$client->phone = $phone->number;
					}

					if($email == null){
						$client->email = "No posee";
					} else {
						//$emails = $client->emails()->where('active_flag', 1)->first();
						$client->email = $email->email;
					}
					
					
						
					
					
				}
        return json_encode(["client"=>$client]);
	}
	
}