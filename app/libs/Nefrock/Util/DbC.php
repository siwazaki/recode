<?php

namespace Nefrock\Util;

use \Nefrock\Exception\ErrUsr;
use \Nefrock\Exception\ErrPrg;

//class for design by contract

class DbC {

  const ERROR_HEADER = "[DbC Error]";

  //Require for users
  //public function RU($expectedTrue, $code3, $messages)
  public function RU() {
    $nbArgs = func_num_args();
    $args = func_get_args();
    $expectedTrue = $args[0];
    if (!$expectedTrue) {
      $code3 = $args[1];
      $message = "";
      for ($i = 2; $i < $nbArgs; $i++) {
        $obj = $args[$i];
        if (!is_string($obj)) {
          $message .= \SU::trimEOL(\SU::inspect($obj)) . " ";
        } else {
          $message .= $obj . " ";
        }
      }
      $dbg = debug_backtrace();
      $outputStr = self::ERROR_HEADER . PHP_EOL .
              "kind    : " . "ErrUsr" . PHP_EOL .
              "code    : " . $code3 . PHP_EOL .
              (isset($dbg[1]['function']) ? "function: " . $dbg[1]['function'] . PHP_EOL : "") .
              (isset($dbg[1]['file']) ? "file    : " . $dbg[1]['file'] . PHP_EOL : "") .
              (isset($dbg[1]['line']) ? "line    : " . $dbg[1]['line'] . PHP_EOL : "") .
              "message : " . $message;
      \Log::error($outputStr);
      throw new ErrUsr($message, $code3, null);
    }
  }

  //Require for programmers
  //RP($expectedTrue, $code3, $messages)
  public function RP() {
    $nbArgs = func_num_args();
    $args = func_get_args();
    $expectedTrue = $args[0];
    if (!$expectedTrue) {
      $code3 = $args[1];
      $message = "";
      for ($i = 2; $i < $nbArgs; $i++) {
        $obj = $args[$i];
        if (!is_string($obj)) {
          $message .= \SU::trimEOL(\SU::inspect($obj)) . " ";
        } else {
          $message .= $obj . " ";
        }
      }
      $dbg = debug_backtrace();
      $outputStr = self::ERROR_HEADER . PHP_EOL .
              "kind    : " . "ErrPrg" . PHP_EOL .
              "code    : " . $code3 . PHP_EOL .
              (isset($dbg[1]['function']) ? "function: " . $dbg[1]['function'] . PHP_EOL : "") .
              (isset($dbg[1]['file']) ? "file    : " . $dbg[1]['file'] . PHP_EOL : "") .
              (isset($dbg[1]['line']) ? "line    : " . $dbg[1]['line'] . PHP_EOL : "") .
              "message : " . $message;
      \Log::error($outputStr);
      throw new ErrPrg($message, $code3, null);
    }
  }

  //Require $arr has $key
  public function RA($key, $arr, $code) {
    $this->RP(array_key_exists($key, $arr), $code, "The array should have key[{$key}].");
  }

}
