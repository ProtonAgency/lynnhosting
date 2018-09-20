<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContainersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('containers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('hash');
			$table->integer('location_id');
			$table->integer('plan_id');
			$table->integer('user_id');
			$table->timestamps();
			$table->string('ftp_password');
			$table->string('domain');
			$table->boolean('change_password');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('containers');
	}

}
