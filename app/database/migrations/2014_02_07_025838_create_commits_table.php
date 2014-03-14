<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commits', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
      $table->integer('repository_id')->unsigned();
      $table->string('comments', 1000)->nullable();
			$table->timestamps();
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('repository_id')->references('id')->on('repositories');
      $table->index(array('user_id','repository_id','created_at',));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('commits');
	}

}
