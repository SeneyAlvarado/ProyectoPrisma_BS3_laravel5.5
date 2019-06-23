<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialWorksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material_works', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('material_id')->unsigned();
			$table->foreign('material_id')->references('id')->on('materials');
			$table->integer('work_id')->unsigned();
			$table->foreign('work_id')->references('id')->on('works');

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('material_works');
	}

}
