<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('details', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('modification_date');
            $table->string('detail', 1000);
            $table->integer('work_id')->unsigned();
            $table->foreign('work_id')->references('id')->on('works');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('details');
	}

}
