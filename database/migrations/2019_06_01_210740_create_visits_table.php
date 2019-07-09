<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits', function(Blueprint $table) {
            $table->increments('id');
            $table->string('client_name', 70);
            $table->dateTime('date');
            $table->integer('phone')->nullable();;
            $table->string('email', 50)->nullable();;
            $table->string('details', 1000);
            $table->integer('visitor_id')->unsigned();
            $table->foreign('visitor_id')->references('id')->on('users');
            $table->integer('recepcionist_id')->unsigned()->nullable();
			$table->foreign('recepcionist_id')->references('id')->on('users');
			$table->integer('branch_id')->unsigned()->nullable();
			$table->foreign('branch_id')->references('id')->on('branches');
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
		Schema::drop('visits');
	}

}
