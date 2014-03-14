<?php

namespace Nefrock\Util;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StringUtil
 *
 * @author iwazaki
 */
class StringUtil {

  public function inspect($obj) {
    ob_start();
    var_dump($obj);
    $res = ob_get_contents();
    ob_end_clean();
    return $res;
  }

  public function trimEOL($str) {
    return str_replace(array("\r\n","\r","\n"), '', $str);
  }

}
