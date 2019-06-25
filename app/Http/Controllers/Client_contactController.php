<?php

namespace App\Http\Controllers;

use App\Client_contact;
use App\Physical_client;
use App\Client;
use App\Phone;
use App\Email;

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

		$contacts = Client_contact::where('client_id', $id)
		->where('active_flag', 1)->get();
		
		foreach($contacts as $contact){//get the name of the contact client.
			$client = Client::where('id', $contact->contact_id)->first();
			$physical_client = Physical_client::where('client_id', $contact->id)->first();
			$contact->identification = $client->identification;
			$contact->contact_name = $client->name . " " . $physical_client->lastname . " " . $physical_client->second_lastname;
			$contact->phone = $this->getPhone($contact->contact_id);
			$contact->email = $this->getEmail($contact->contact_id);
		}

		//return $contacts;
		return view('client_contacts.index', compact('contacts'));
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('client_contacts.create');
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

		return redirect()->route('client_contacts.index')->with('message', 'Item created successfully.');
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

		return redirect()->route('client_contacts.index')->with('message', 'Item deleted successfully.');
	}
}