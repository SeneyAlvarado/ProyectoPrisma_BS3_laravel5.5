<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateUserTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('state_user_types', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('states_id')->unsigned();
            $table->foreign('states_id')->references('id')->on('states');
            $table->integer('user_types_id')->unsigned();
            $table->foreign('user_types_id')->references('id')->on('user_types');
			$table->integer('state_notification');
			$table->integer('view_state');
			$table->integer('edit_state');
            $table->integer('active_flag');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('state_user_types');
	}

}
