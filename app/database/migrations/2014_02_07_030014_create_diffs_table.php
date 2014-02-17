<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diffs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('commit_id')->unsigned();
			$table->timestamps();
      $table->index(array('created_at','commit_id'));
      $table->foreign('commit_id')->references('id')->on('commits');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('diffs');
	}

}
