<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoftwareTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('software', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('version');
			$table->string('command', 5000)->nullable();
			$table->timestamps();
			$table->string('before_commands', 5000)->nullable();
			$table->string('after_commands', 5000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('software');
	}

}
