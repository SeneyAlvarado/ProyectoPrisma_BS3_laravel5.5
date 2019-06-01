<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateWorksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('state_work', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('states_id')->unsigned();
            $table->foreign('states_id')->references('id')->on('states');
            $table->integer('work_id')->unsigned();
            $table->foreign('work_id')->references('id')->on('works');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('state_works');
	}

}
