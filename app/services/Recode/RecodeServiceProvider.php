<?php

namespace Recode;

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
class RecodeServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->app->singleton('stats', function() {
              return new \Recode\Service\Stats();
            });

  }

}
