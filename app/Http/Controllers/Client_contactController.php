<?php

namespace App\Http\Controllers;

use App\Client_contact;
use App\Physical_client;
use App\Client;
use App\Phone;
use App\Email;
use Auth;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Client_contactController extends Controller
{
	/**
	 * Variable to model
	 *
	 * @var client_contact
	 */
	protected $model;

	/**
	 * Create instance of controller with Model
	 *
	 * @return void
	 */
	public function __construct(Client_contact $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the contacts of the client.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando los contactos");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");

		$contacts = Client_contact::where('client_id', $id)->where('contact_id', '!=', $id)
		->where('active_flag', 1)->get();
		
		foreach($contacts as $contact){//get the name of the contact client.
			$client = Client::where('id', $contact->contact_id)->first();
			$physical_client = Physical_client::where('client_id', $contact->contact_id)->first();
			$contact->identification = $client->identification;
			$contact->contact_name = $client->name . " " . $physical_client->lastname . " " . $physical_client->second_lastname;
			$contact->phone = $this->getPhone($contact->contact_id);
			$contact->email = $this->getEmail($contact->contact_id);
			//$contact->client_owner = $id;
		}

		$user_type = Auth::user()->user_type_id;
		if($user_type == 1){//admin user
			return view('admin.client_contacts.index', compact('contacts','id'));	
		} else if($user_type == 2){//reception user
			return view('reception.client_contacts.index', compact('contacts','id'));	
		}
		
	}

/**
	 * 
	 * Get the phone number of a specific client
	 * 
	 */
	private function getPhone($id){
		$phone = DB::table('phones')
		->where('client_id', '=', $id)
		->first();
		$phone_number;
		if($phone == null ) {
			$phone_number = "No posee";
		} else {
			$phone_number = $phone->number;
		}
		return $phone_number;//return the phone number of the client
	}

	/**
	 * 
	 * Get the email of a specific client
	 * 
	 */
	private function getEmail($id){
		$email = DB::table('emails')
		->where('client_id', '=', $id)
		->first();
		$email_client;
		if($email == null) {
			$email_client = "No posee";
		} else {
			$email_client = $email->email;
		}
		return $email_client;//return the email of the client
	}

	/**
	 * Show the form to create a new contact
	 *
	 * @return Response
	 */
	public function create($id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " mostrando los contactos");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "error");

		$contacts = Client_contact::where('client_id', $id)
		->where('active_flag', 1)->get();

		//return $contacts;
		$contactsID = array();
		if (is_array($contacts) || is_object($contacts))
		{
    		foreach ($contacts as $contact)
    		{
				array_push($contactsID, $contact->contact_id);
			}
			
			//return $contactsID;
			//if the client has contacts, do not bring those contacts
			//this is made to nullify the posibility of adding the same contact more than once
			$clients = Client::where('active_flag', 1)
			->where('type', 1)
			->where('id', '<>', $id)
			->whereNotIn('clients.id', $contactsID)
			->get();
		} else {
			//if the client doesn´t have any contact
			$clients = Client::where('active_flag', 1)
			->where('type', 1)
			->where('id', '<>', $id)
			->get();
		}

		$owner_name = Client::where('id', $id)->first();
		
		foreach($clients as $client){//get the name of the contact client.
			$physical_client = Physical_client::where('client_id', $client->id)->first();
			$client->name = $client->name . " " . $physical_client->lastname . " " . $physical_client->second_lastname;
			$client->phone = $this->getPhone($client->id);
			$client->email = $this->getEmail($client->id);
			$client->owner_name = $owner_name->name;
			$client->owner_id = $id;
		}
		
		return json_encode(["clients"=>$clients]);
	}

	/**
	 * Store a newly contact in the table client_contacts.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store($owner_id, $contact_id)
	{
		//custom message if this methods throw an exception
		\Session::put('errorOrigin', " agregando el contacto");

		//custom route to REDIRECT redirect('x') if there's an error
		\Session::put('errorRoute', "clients.index");
		
		$client_contact = new Client_contact();
		$client_contact->client_id = $owner_id;
		$client_contact->contact_id = $contact_id;
		$client_contact->active_flag = 1;
		$client_contact->save();
		
		return json_encode(["client_contact"=>$client_contact]);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client_contact = $this->model->findOrFail($id);
		
		return view('client_contacts.show', compact('client_contact'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client_contact = $this->model->findOrFail($id);
		
		return view('client_contacts.edit', compact('client_contact'));
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

		$client_contact = $this->model->findOrFail($id);		
		$client_contact->update($inputs);

		return redirect()->route('client_contacts.index')->with('message', 'Item updated successfully.');
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

		$destroy = "delete";
		return json_encode(["client_contact"=>$destroy]);

	}
}