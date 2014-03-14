<?php

class UsersTableSeeder extends Seeder {

  public function run() {
    DB::table('users')->delete();
    $records = array(
        array('id' => 1, 'email' => 's.iwazaki@gmail.com', 'password' => Hash::make('neforck2013')),
        array('id' => 2, 'email' => 'siwazaki@nefrock.com', 'password' => Hash::make('neforck2013')),
    );
    DB::table('users')->insert($records);
  }

}
