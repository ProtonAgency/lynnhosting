<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatabasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('databases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('host');
			$table->string('user');
			$table->string('password');
			$table->string('name');
			$table->integer('user_id');
			$table->timestamps();
			$table->string('container_id');
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
		Schema::drop('databases');
	}

}
