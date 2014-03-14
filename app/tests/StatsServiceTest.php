<?php

class StatsServiceTest extends TestCase {

  public function testGetAve() {
    $res = \Stats::getAve(1, new DateTime('2014-01-29'), new DateTime('2014-01-30'));
    $this->assertGreaterThan(0, $res);
  }

  public function testGetVar() {
    $ave = \Stats::getAve(1, new DateTime('2014-01-29'), new DateTime('2014-02-20'));
    $var = \Stats::getVar(1, new DateTime('2014-01-29'), new DateTime('2014-02-20'), $ave);
    $this->assertGreaterThan(0, $var);
  }

  public function testGetMax() {
    $max = \Stats::getMax(1, new DateTime('2014-01-29'), new DateTime('2014-02-20'));
    $this->assertGreaterThan(0, $max);
  }

  public function testGetStats() {
    $stats = \Stats::getStats(1, new DateTime('2014-01-29'), new DateTime('2014-02-20'));
    $this->assertArrayHasKey('ave', $stats);
    $this->assertArrayHasKey('var', $stats);
    $this->assertArrayHasKey('max', $stats);
  }

}