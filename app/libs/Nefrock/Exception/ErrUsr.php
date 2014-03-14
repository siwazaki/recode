<?php

namespace Nefrock\Exception;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrUsr
 *
 * @author iwazaki
 */
class ErrUsr extends \Exception {

  private $errorCodeStr;

  function __construct($message, $errorCodeStr, $previous) {
    parent::__construct($message, 0, $previous);
    $this->errorCodeStr = $errorCodeStr;
  }

  public function getErrorCode()
  {
    return $this->errorCodeStr;
  }



}
