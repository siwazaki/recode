<?php

class CalTableSeeder extends Seeder {

  public function run() {
    DB::table('years')->delete();
    DB::table('months')->delete();
    DB::table('days')->delete();
    DB::table('hours')->delete();

    $years = array();
    $months = array();
    $days = array();
    $hours = array();
    for ($year = 2013; $year <= 2100; ++$year)
      $years[] = array('year' => $year);
    for ($month = 1; $month <= 12; ++$month)
      $months[] = array('month' => $month);
    for ($day = 1; $day <= 31; ++$day)
      $days[] = array('day' => $day);
    for ($hour = 0; $hour <= 23; ++$hour) {
      $hours[] = array('hour' => $hour);
    }

    DB::table('years')->insert($years);
    DB::table('months')->insert($months);
    DB::table('days')->insert($days);
    DB::table('hours')->insert($hours);
  }

}
