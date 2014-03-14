<?php

namespace Recode\Service;

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
class Stats {

  public function getStats($userId, \DateTime $dateFrom, \DateTime $dateTo) {
    $ave = $this->getAve($userId, $dateFrom, $dateTo);
    return array(
        'ave' => round($ave,2),
        'var' => round($this->getVar($userId, $dateFrom, $dateTo, $ave),2),
        'max' => $this->getMax($userId, $dateFrom, $dateTo),
        'sum' => $this->getSum($userId, $dateFrom, $dateTo),
    );
  }

  public function getMax($userId, \DateTime $dateFrom, \DateTime $dateTo) {
    $query = \Commit::CommitsAllSummaryBetween($userId, $dateFrom, $dateTo);
    $query->select(array(\DB::raw('count(*) AS nb_commits')));
    return $query->get()->max('nb_commits');
  }

  public function getAve($userId, \DateTime $dateFrom, \DateTime $dateTo) {
    $query = \Commit::CommitsAllBetween($userId, $dateFrom, $dateTo);
    $query->select(array(\DB::raw('count(*) AS nb_commits')));
    $nbCommits = $query->first()->nb_commits;
    $dayD = $dateFrom->diff($dateTo)->days + 1;
    $ave = $nbCommits / $dayD;
    return $ave;
  }

  public function getVar($userId, \DateTime $dateFrom, \DateTime $dateTo, $ave) {
    \DbC::RU($dateFrom <= $dateTo, 100, '$dateFrom <= $dateTo');
    $query = \Commit::CommitsAllSummaryBetween($userId, $dateFrom, $dateTo);
    $query->select(\DB::raw("POW(count(*) - ${ave}, 2) as sum"));
    $sumCommits = $query->get();

    $sum = 0;
    foreach ($sumCommits as $sumCommit) {
      $s = $sumCommit->sum;
      $sum = $sum + $s;
    }

    $dayD = $dateFrom->diff($dateTo)->days + 1;
    $nbDiff = $dayD - $sumCommits->count();
    $powAve = $ave * $ave;
    for ($i = 0; $i < $nbDiff; ++$i) {
      $sum += $powAve;
    }
    return (float) ($sum / (float) $dayD);
  }

  public function getSum($userId, \DateTime $dateFrom, \DateTime $dateTo) {
    $query = \Commit::CommitsAllBetween($userId, $dateFrom, $dateTo);
    $query->select(array(\DB::raw('count(*) AS nb_commits')));
    $nbCommits = $query->first()->nb_commits;
    return $nbCommits;
  }

}
