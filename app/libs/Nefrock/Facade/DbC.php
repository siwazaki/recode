<?php

namespace Nefrock\Facade;

use Illuminate\Support\Facades\Facade;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Arival
 *
 * @author iwazaki
 */
class DbC extends Facade {

  protected static function getFacadeAccessor() {
    return 'dbc';
  }

}
