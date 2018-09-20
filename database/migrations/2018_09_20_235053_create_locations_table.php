<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('hash');
			$table->string('host');
			$table->string('port');
			$table->boolean('ssl');
			$table->timestamps();
			$table->string('name');
			$table->string('password');
			$table->boolean('http_online');
			$table->boolean('proxy_online');
			$table->boolean('database_online');
			$table->string('last_updated');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}

}
