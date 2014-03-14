<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->call('UsersTableSeeder');
    $this->call('RepositoriesTableSeeder');
		$this->call('CommitsTableSeeder');
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$this->call('CalTableSeeder');
	}

}