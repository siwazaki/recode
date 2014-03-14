<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    //年テーブル
    Schema::create('years', function($table) {
              $table->engine = 'InnoDB';
              $table->integer('year')->unsigned();
              $table->unique('year');
            });


    //月テーブル
    Schema::create('months', function($table) {
              $table->engine = 'InnoDB';
              $table->tinyInteger('month');
              $table->unique('month');
            });

    //日テーブル
    Schema::create('days', function($table) {
              $table->engine = 'InnoDB';
              $table->tinyInteger('day');
              $table->unique('day');
            });

    //時間テーブル
    Schema::create('hours', function($table) {
              $table->engine = 'InnoDB';
              $table->tinyInteger('hour');
              $table->unique('hour');
            });

    //カレンダービュー
    DB::statement("CREATE VIEW `d_cal` AS
select
  `years`.`year` AS `year`,
  `months`.`month` AS `month`,
  `days`.`day` AS `day`,
  cast(concat(`years`.`year`,'-',`months`.`month`,'-',`days`.`day`) as date) AS `date`,
  DAYOFWEEK(concat(`years`.`year`,'-',`months`.`month`,'-',`days`.`day`)) as dayofweek
from
  ((`years` join `months`) join `days`)
where (cast(concat(`years`.`year`,'-',`months`.`month`,'-',`days`.`day`) as date) is not null)
order by
  `years`.`year`,`months`.`month`,`days`.`day`");


    //カレンダー+時間ビュー
    DB::statement("CREATE VIEW `t_cal` AS
select
  `years`.`year` AS `year`,
  `months`.`month` AS `month`,
  `days`.`day` AS `day`,
  `hours`.`hour` AS `hour`,
  cast(concat(`years`.`year`,'-',`months`.`month`,'-',`days`.`day`) as date) AS `date`,
  DAYOFWEEK(concat(`years`.`year`,'-',`months`.`month`,'-',`days`.`day`)) as dayofweek
from
  (((`years` join `months`) join `days`) join `hours`)
where (cast(concat(`years`.`year`,'-',`months`.`month`,'-',`days`.`day`) as date) is not null)
order by
  `years`.`year`,`months`.`month`,`days`.`day`, `hours`.`hour`");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('years');
    Schema::drop('months');
    Schema::drop('days');
    Schema::drop('hours');
    DB::statement('DROP VIEW IF EXIST d_cal');
    DB::statement('DROP VIEW IF EXIST h_cal');
  }

}
