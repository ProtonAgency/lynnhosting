<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('databases');
			$table->integer('storage');
			$table->integer('bandwidth');
			$table->integer('emails');
			$table->timestamps();
			$table->string('price');
			$table->string('braintree_id');
			$table->integer('domains');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plans');
	}

}
