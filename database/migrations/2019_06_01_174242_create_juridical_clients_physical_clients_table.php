<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicalClientsPhysicalClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('juridical_clients_physical_clients', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('physical_client_id')->unsigned();
            $table->foreign('physical_client_id')->references('id')->on('physical_clients');
            $table->integer('juridical_client_id')->unsigned();
            $table->foreign('juridical_client_id')->references('id')->on('juridical_clients');
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
		Schema::drop('juridical_clients_physical_clients');
	}

}
