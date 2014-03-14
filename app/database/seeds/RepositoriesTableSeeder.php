<?php

class RepositoriesTableSeeder extends Seeder {

  public function run() {
    DB::table('repositories')->delete();
    $records = array(
        array('id' => 1, 'user_id' => 1, 'name' => 'recode', 'auth_key' => 'should be added'),
        array('id' => 2, 'user_id' => 1, 'name' => 'w3package', 'auth_key' => 'should be added'),
        array('id' => 3, 'user_id' => 1, 'name' => 'worldsupply', 'auth_key' => 'should be added'),
        array('id' => 4, 'user_id' => 1, 'name' => 'pressoinn', 'auth_key' => 'should be added'),
        array('id' => 5, 'user_id' => 1, 'name' => 'umi', 'auth_key' => 'should be added'),
        array('id' => 6, 'user_id' => 2, 'name' => 'hoge', 'auth_key' => 'should be added'),
        array('id' => 7, 'user_id' => 2, 'name' => 'worldsupply_ht', 'auth_key' => 'should be added'),
    );
    DB::table('repositories')->insert($records);
  }

}
