<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('works', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('priority');
            $table->integer('advance_payment');
            $table->dateTime('approximate_date');
            $table->dateTime('designer_date');
            $table->dateTime('print_date');
            $table->dateTime('post_production_date');
            $table->integer('drying_hours');
            $table->string('observation', 1500);
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
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
		Schema::drop('works');
	}

}
