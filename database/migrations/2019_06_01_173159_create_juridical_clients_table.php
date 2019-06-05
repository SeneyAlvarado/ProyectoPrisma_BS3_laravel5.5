<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicalClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('juridical_clients', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients');
            //$table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('juridical_clients');
	}

}
