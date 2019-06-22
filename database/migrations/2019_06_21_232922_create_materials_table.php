<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materials', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->integer('active_flag');
            $table->string('description', 100)->nullable();
			$table->integer('branch_id')->unsigned();
			$table->foreign('branch_id')->references('id')->on('branches');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('materials');
	}

}
