<?php

namespace Nefrock;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArivalServiceProvider
 *
 * @author iwazaki
 */
class NefrockServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {
    $this->app->bind('dbc', function() {
      return new \Nefrock\Util\Dbc();
    });
    $this->app->bind('string_util', function() {
      return new \Nefrock\Util\StringUtil();
    });
    $this->app->bind('date_util', function() {
      return new \Nefrock\Util\DateUtil();
    });
  }

}
