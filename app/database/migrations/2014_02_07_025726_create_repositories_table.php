<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepositoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('repositories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned;
      $table->string('name', 100);
      $table->string('auth_key', 64);
			$table->timestamps();
      $table->unique(array('user_id', 'name'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('repositories');
	}

}
