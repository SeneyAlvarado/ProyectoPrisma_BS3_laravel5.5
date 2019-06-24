<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('entry_date');
            $table->integer('quotation_number')->nullable();
            $table->integer('client_owner')->unsigned();
            $table->foreign('client_owner')->references('id')->on('clients');
            $table->integer('client_contact')->unsigned();
            $table->foreign('client_contact')->references('id')->on('clients');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('branch_id')->unsigned();
			$table->foreign('branch_id')->references('id')->on('branches');
			$table->integer('coin_id')->unsigned();
			$table->foreign('coin_id')->references('id')->on('coins');
			$table->decimal('exchange_rate', 7, 2);
			$table->decimal('total', 10, 2)->nullable();
			$table->decimal('advance_payment', 10, 2)->nullable();
            $table->integer('active_flag');
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
		Schema::drop('orders');
	}

}
